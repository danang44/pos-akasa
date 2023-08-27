var T = function () {
    let trayek = {}

    var T_ = this;
    var dashboard = null;
    var polyline = null;
    var map = null;
    var formActive = null;
    var dragActiveIndex = null;
    var dropdownItem = [];
    var points = [];
    var pointsBusStop = [];
    var layerGroup = null;

    var areaWaypoint = [];
    var initialWaypoint = [];
    var markerWaypoint = null;
    var polyLatLng = null
    var waypointLatLng = null;
    var alphabet = [];

    trayek.load = function (dashboard) {
        this.dashboard = dashboard;
        this.layerGroup = L.featureGroup()

        this.polyline = null;
        this.map = null;
        this.formActive = null;
        this.dragActiveIndex = null;

        this.dropdownItem = [];
        this.points = [[], []];
        this.pointsBusStop = [];

        this.areaWaypoint = [];
        this.initialWaypoint = [];
        this.markerWaypoint = null;
        this.polyLatLng = null
        this.waypointLatLng = null;
        this.alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

        $(function () {
            $(document).on("click", ".item-point", function (e) {
                if (e.target.className.split(" ").some(r => { return ['checkbox-point', 'uil-edit', 'uil-times'].includes(r) }) == true) return;
                const index = $('.item-point').index($(this));

                if (T.points[index] && T.points[index].hasOwnProperty('marker')) {
                    T.points[index].marker.openPopup();
                    T.map.flyTo(T.points[index].marker._latlng, T.map.getZoom(), { animate: 0.1, paddingTopLeft: [350, 0] })
                }
            })
                .on("dragstart", ".item-point", function (e) {
                    const $this = $(this);
                    const items = $('.item-point');
                    T.dragActiveIndex = items.index($(this));

                    setTimeout(() => $this.addClass("dragging"), 0);
                }).on("dragend", ".item-point", function (e) {
                    $(this).removeClass("dragging");

                    $(".bullet").each(function (index) { $(this).html(T.alphabet[index]); });

                    const items = $('.item-point');
                    const index = items.index($(this));
                    const enc = $(this).find('span').data('restore');

                    var draggingIndex = T.points.findIndex(item => {
                        if (item && item.hasOwnProperty('data')) {
                            return item.data.enc == enc;
                        } else {
                            return false;
                        }
                    });

                    if (draggingIndex == -1) {
                        draggingIndex = T.dragActiveIndex;
                    }

                    const draggingItem = T.points[draggingIndex];

                    T.points.splice(draggingIndex, 1);
                    T.points.splice(index, 0, draggingItem);

                    T.reMarker()
                    T.getRoutes();
                }).on("dragover", ".sortable-point", function (e) {
                    e.preventDefault();

                    const list = document.querySelector(".sortable-point");
                    const draggingItem = list.querySelector(".dragging");
                    const siblings = [...list.querySelectorAll(".item-point:not(.dragging)")];

                    let nextSibling = siblings.find(sibling => {
                        return e.target.offsetTop + e.target.offsetHeight / 2 <= sibling.offsetTop + sibling.offsetHeight / 2;
                    });

                    list.insertBefore(draggingItem, nextSibling);
                }).on("dragenter", ".sortable-point", function (e) {
                    e.preventDefault();
                })
        });
    }

    trayek.reset = () => {
        if (T.polyline != null) { T.layerGroup.removeLayer(T.polyline); }
        if (T.markerWaypoint != null) { T.layerGroup.removeLayer(T.markerWaypoint); }
        T.points.forEach((el, index) => {
            T.layerGroup.removeLayer(el.marker);
        })

        T.polyline = null;
        T.formActive = null;
        T.dropdownItem = [];
        T.points = [[], []];

        T.areaWaypoint = [];
        T.initialWaypoint = [];
        T.markerWaypoint = null;
        T.polyLatLng = null
        T.waypointLatLng = null;
    }

    trayek.waypoint_form = function (index, data) {
        return `<li class="item item-point" draggable="true">
                    <div class="item-point-details">
                        <i class="uil uil-draggabledots"></i>
                        <div class="blt ${data.bs_stop == '1' ? 'bullet' : 'bullet-outline'}">${data.bs_stop == '1' ? T.alphabet[index] : 'A'}</div>
                        <input class="input-point" type="" name="" value="${data.bs_nm}" style="display:none">
                        <span data-restore="${data.enc}" style="display:block">${data.bs_nm}</span>
                        <div class="action-point">
                            <input type="checkbox" class="checkbox-point hidden" title="Titik Bus Stop?" ${data.bs_stop == '1' ? 'checked' : ''}>
                            <a href="#" class="edit-point hidden"><i class="bx bx-search-alt"></i></a>
                            <a href="#" class="rename-point hidden"><i class="bx bx-rename"></i></a>
                            <a href="#" class="remove-point hidden"><i class="uil uil-times"></i></a>
                        </div>
                    </div>
                </li>`;
    }

    trayek.form = function (x) {
        return `<li class="item item-point" draggable="true">
                    <div class="item-point-details">
                        <i class="uil uil-draggabledots"></i>
                        <div class="blt bullet">${T.alphabet[x]}</div>
                        <input class="input-point" type="" name="" value="">
                        <span></span>
                        <div class="action-point">
                            <input type="checkbox" class="checkbox-point hidden" title="Titik Bus Stop?" checked>
                            <a href="#" class="edit-point hidden"><i class="bx bx-search-alt"></i></a>
                            <a href="#" class="rename-point hidden"><i class="bx bx-rename"></i></a>
                            <a href="#" class="remove-point hidden"><i class="uil uil-times"></i></a>
                        </div>
                    </div>
                </li>`;
    }

    trayek.info_window = function (element) {
        return element.bs_nm;
    }

    trayek.dropdown_item = function (data, index) {
        return `<li class="dropdown-item dropdown-items" data-index="${index}">
                    <div class="name">${data.bs_nm}</div>
                    <div class="type">${data.bs_stop == "1" ? 'bus stop' : 'waypoint'}</div>
                    <div class="address">${data.addr}</div>
                </li>`;
    }

    trayek.marker_icon = function (alpha, bs_stop) {
        return L.divIcon({
            className: 'custom-icon',
            html: '<div class="' + (bs_stop == '1' ? 'bullet-map' : 'bullet-outline-map') + '">' + (bs_stop == '1' ? alpha : '.') + '</div>',
            iconSize: ["unset", "unset"],
            iconAnchor: (bs_stop == '1' ? [15, 15] : [12, 12])
        });
    }

    trayek.waypoint_icon = function () {
        return L.divIcon({
            className: 'custom-icon',
            html: '<div class="waypoint-map"><i class="uil uil-plus"></i></div>',
            iconSize: ["unset", "unset"],
            iconAnchor: [15, 15]
        });
    }

    trayek.debounce = function (func, delay) {
        let debounceTimer
        return function () {
            const context = this
            const args = arguments
            clearTimeout(debounceTimer)
            debounceTimer
                = setTimeout(() => func.apply(context, args), delay)
        }
    }

    trayek.getBusStop = function (param, func) {
        $.ajax({
            type: "POST",
            url: T.dashboard.baseUrl + '/kspn/ajax/jsonSearchBusStop',
            data: {
                "paramName": param,
                [T.dashboard.csrfName]: T.dashboard.csrfHash
            },
            dataType: "json",
            success: function (response) {
                func(response);
            }
        });
    }

    trayek.getRoutes = function (zoom = 13) {
        if (T.points.length > 1 && T.points.every(point => { return point.hasOwnProperty('data') })) {
            const coordinate = T.points.map(point => { return `${point.data.bs_lat},${point.data.bs_lng}` }).join("%7C");
            $.ajax({
                type: "get",
                url: T.dashboard.baseUrl + '/kspn/ajax/jsonGetRoutesfromPoints2/' + coordinate,
                dataType: "json",
                success: function (response) {
                    const encodedLine = response.data.paths[0].points;
                    const encodedWaypoint = response.data.paths[0].snapped_waypoints;

                    T.polyLatLng = L.PolylineUtil.decode(encodedLine);
                    T.waypointLatLng = L.PolylineUtil.decode(encodedWaypoint);

                    if (T.polyline != null) { T.layerGroup.removeLayer(T.polyline); }
                    T.polyline = L.Polyline.fromEncoded(encodedLine, {
                        stroke: true,
                        color: $("#input-color").val(),
                        weight: 4,
                        fill: false,
                        fillOpacity: 1
                    }).addTo(T.layerGroup);

                    T.polyline.on('mouseover', function (e) {
                        const icon = T.waypoint_icon();
                        // if(map.getZoom()>14){                        
                        if (T.markerWaypoint === null) {
                            T.markerWaypoint = L.marker(e.latlng, { icon: icon, draggable: true }).on('dragstart', T.wpDragStart).on('dragend', T.wpDragEnd).addTo(T.layerGroup);
                        } else {
                            T.markerWaypoint.setLatLng(e.latlng);
                        }
                        // }
                    });

                    T.reMarker();
                    T.map.flyToBounds(T.layerGroup.getBounds(), { duration: 0.5, maxZoom: zoom, paddingTopLeft: [350, 0] });
                }
            });
        }
    }

    trayek.moveBusStop = (e) => {
        const latlng = e.target._latlng;
        console.log(e.target.options.icon);
        const currentMarkerIndex = T.points.findIndex(point => {
            return point.marker.options.icon == e.target.options.icon;
        })

        trayek.getBusStop(`${latlng.lat},${latlng.lng}`, function (response) {
            if (response.bus_stop.length > 0) {
                const data = response.bus_stop[0];
                data.bs_stop = T.points[currentMarkerIndex].data.bs_stop;
                T.points[currentMarkerIndex].data = data;
                T.points[currentMarkerIndex].marker.bindPopup(T.info_window(data), { offset: L.point(-5, -5) }).bindTooltip(T.info_window(data), { offset: L.point(-5, -20), direction: 'top' });
                $('.item-point').eq(currentMarkerIndex).find('span').data('restore', response.bus_stop[0].enc);
                $('.item-point').eq(currentMarkerIndex).find('span').html(response.bus_stop[0].bs_nm);

                T.reMarker();
                T.getRoutes(T.map.getZoom());
            }
        })
    }

    trayek.wpDragStart = (e) => {
        const latlng = e.target._latlng;
        T.initialWaypoint = [latlng.lat, latlng.lng];
    }

    trayek.wpDragEnd = (e) => {
        const latlng = e.target._latlng;
        const nearestIndex = T.nearest(T.initialWaypoint, T.polyLatLng);

        T.areaWaypoint = [];
        T.waypointLatLng.forEach((el, index) => {
            if (index < T.waypointLatLng.length - 1) {
                const firstIndex = T.polyLatLng.findIndex(latLng => { return latLng[0] == el[0] && latLng[1] == el[1] });
                const secondIndex = T.polyLatLng.findIndex(latLng => { return latLng[0] == T.waypointLatLng[index + 1][0] && latLng[1] == T.waypointLatLng[index + 1][1] });

                T.areaWaypoint[index + 1] = [firstIndex, secondIndex];
            }
        });

        const areaIndex = T.areaWaypoint.findIndex(a => {
            if (a) {
                return a[0] <= nearestIndex && a[1] >= nearestIndex;
            } else {
                return false;
            }
        });

        // console.log(T.points);

        trayek.getBusStop(`${latlng.lat},${latlng.lng}`, function (response) {
            if (response.bus_stop.length > 0) {
                const form = T.waypoint_form(25, response.bus_stop[0]);
                const data = [];
                data.data = response.bus_stop[0];
                data.marker = T.markerWaypoint.off('dragstart', T.wpDragStart).off('dragend', T.wpDragEnd).on('dragend', T.moveBusStop).bindPopup(T.info_window(data.data), { offset: L.point(-5, -5) }).bindTooltip(T.info_window(data.data), { offset: L.point(-5, -20), direction: 'top' });
                T.points.splice(areaIndex, 0, data);

                T.markerWaypoint = null;

                $(".sortable-point > li:nth-of-type(" + areaIndex + ")").after(form);
                $(".bullet").each(function (index) { $(this).html(T.alphabet[index]); });

                T.reMarker();
                T.getRoutes(T.map.getZoom());
            }
        })
    }

    trayek.reMarker = () => {
        T.pointsBusStop = T.points.filter(x => { return x.data && x.data.hasOwnProperty('bs_stop') && x.data.bs_stop === '1' });
        T.points.forEach((element, index) => {
            if (element && element.hasOwnProperty('marker')) {
                const ind = T.pointsBusStop.findIndex(x => { return x == element });
                const icon = T.marker_icon(T.alphabet[ind], element.data.bs_stop);
                element.marker.setIcon(icon);
            }
        });
    }

    trayek.nearest = (point, vs) => {
        var currIndex = -1;
        var distance = 9999999999999999;

        vs.forEach((el, index) => {
            var new_distance = trayek.getDistance(point, el);
            currIndex = (new_distance < distance) ? index : currIndex;
            distance = (new_distance < distance) ? new_distance : distance;
        });

        return currIndex;
    };

    trayek.getDistance = (origin, destination) => {
        var lon1 = trayek.toRadian(origin[1]),
            lat1 = trayek.toRadian(origin[0]),
            lon2 = trayek.toRadian(destination[1]),
            lat2 = trayek.toRadian(destination[0]);

        var deltaLat = lat2 - lat1;
        var deltaLon = lon2 - lon1;

        var a = Math.pow(Math.sin(deltaLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon / 2), 2);
        var c = 2 * Math.asin(Math.sqrt(a));
        var EARTH_RADIUS = 6371;

        return c * EARTH_RADIUS * 1000;
    }

    trayek.toRadian = (degree) => {
        return degree * Math.PI / 180;
    }

    // trayek.dragElement = (elmnt) => {
    //     var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    //     const dragMouseDown = (e) => {
    //         e = e || window.event;
    //         e.preventDefault();
    //         // get the mouse cursor position at startup:
    //         pos3 = e.clientX;
    //         pos4 = e.clientY;
    //         console.log(pos3+' '+pos4);
    //         document.onmouseup = closeDragElement;
    //         // call a function whenever the cursor moves:
    //         document.onmousemove = elementDrag;
    //     }

    //     const elementDrag = (e) => {
    //         e = e || window.event;
    //         e.preventDefault();
    //         // calculate the new cursor position:
    //         pos1 = pos3 - e.clientX;
    //         pos2 = pos4 - e.clientY;
    //         pos3 = e.clientX;
    //         pos4 = e.clientY;
    //         // set the element's new position:

    //         elmnt.style.top = ((elmnt.offsetTop - pos2)<65?65:(elmnt.offsetTop - pos2)) + "px";
    //         elmnt.style.left = ((elmnt.offsetLeft - pos1)<20?20:(elmnt.offsetLeft - pos1)) + "px";
    //         // console.log(elmnt.style.top);
    //         // console.log(elmnt.style.left);
    //     }

    //     const closeDragElement = () => {
    //         /* stop moving when mouse button is released:*/
    //         document.onmouseup = null;
    //         document.onmousemove = null;
    //     }

    //     if (document.getElementById(elmnt.id + "-header")) {
    //         /* if present, the header is where you move the DIV from:*/
    //         document.getElementById(elmnt.id + "-header").onmousedown = dragMouseDown;
    //         console.log('dragMouseDownHeader');
    //     } else {
    //         /* otherwise, move the DIV from anywhere inside the DIV:*/
    //         elmnt.onmousedown = dragMouseDown;
    //         console.log('dragMouseDown');
    //     }
    // }

    var _foo1 = function () {
        console.log('foo 1 without param');
    }

    var _foo2 = function (a, b) {
        console.log(a);
        console.log(b);
    }

    return trayek;
}();