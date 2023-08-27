class CoreEvents {

    constructor() { }

    load(filter, placeholder = '', dom = 'Blfrtip', buttons, columnDefs) {
        var thisClass = this;
        // alert('CoreEvents');

        //Destroy the old Datatable
        $('#datatable').DataTable().clear().destroy();
        this.table = $('#datatable').DataTable({
            "serverSide": true,
            "processing": true,
            "ordering": true,
            "paging": true,
            "searching": { "regex": true },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "language": {
                "searchPlaceholder": placeholder,
                "processing": "<div class='spinner-border spinner-border-sm' role='status'></div>",
                "sProcessing": "<image src='" + thisClass.ajax + "/../../assets/gif/spinner.gif' width='100px' height='100px' />",
            },
            "pageLength": 10,
            "searchDelay": 2000,
            "ajax": {
                "type": "POST",
                "url": thisClass.url + "_load",
                "dataType": "json",
                "data": function (data) {
                    data.filter = filter
                    // console.log(thisClass);
                    // Grab form values containing user options
                    dataStart = data.start;
                    let form = {};
                    Object.keys(data).forEach(function (key) {
                        form[key] = data[key] || "";
                    });

                    // Add options used by Datatables
                    let info = {
                        "start": data.start || 0,
                        "length": data.length,
                        "draw": 1
                    };

                    $.extend(form, info);
                    $.extend(form, thisClass.csrf);

                    return form;
                },
                "complete": function (response) {
                    // console.log(response);
                    // feather.replace();
                }
            },
            "columns": thisClass.tableColumn,
            "dom": dom,
            "buttons": buttons,
            "columnDefs": columnDefs,
        }).on('init.dt', function () {
            $(this).css('width', '100%');
        });

        $(document).on('submit', '#form', function (e) {
            e.preventDefault();
            let $this = $(this);

            Swal.fire({
                title: "Simpan data ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        title: "",
                        icon: "info",
                        text: "Proses menyimpan data, mohon ditunggu...",
                        didOpen: function () {
                            Swal.showLoading()
                        }
                    });

                    $.ajax({
                        url: thisClass.url + "_save",
                        type: 'post',
                        data: $this.serialize(),
                        dataType: 'json',
                        success: function (result) {
                            Swal.close();
                            if (result.success) {
                                Swal.fire('Sukses', thisClass.insertHandler.placeholder, 'success');
                                $('#form').trigger("reset");
                                thisClass.table.ajax.reload();
                                thisClass.insertHandler.afterAction(result);
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            });
        }).on('reset', '#form', function () {
            $('#id').val('');
            $(".sel2").val(null).trigger('change');
            thisClass.resetHandler.action();
        });

        $(document).on('click', '.edit', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_edit",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#form').trigger("reset");
                        for (var keyy in result.data) {
                            $('#' + keyy).val(result.data[keyy]);
                        }

                        // console.log($('ul#tab li a').last());

                        //$('ul#tab li a').first().trigger('click');
                        // $('.nav-tabs li:eq(0) a').tab('show');
                        $('.nav-tabs li:contains(Update) a').tab('show');
                        thisClass.editHandler.afterAction(result);
                    } else {
                        Swal.fire('Error', result.message, 'error');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('click', '.delete', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "Hapus data ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                confirmButtonColor: '#d33',
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: thisClass.url + "_delete",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function (result) {
                            Swal.close();
                            if (result.success) {
                                Swal.fire('Sukses', thisClass.deleteHandler.placeholder, 'success');
                                thisClass.table.ajax.reload();
                                thisClass.deleteHandler.afterAction();
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            })
        });

        // detail modal
        $(document).on('click', '.detail', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_detail",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('change', '.upload-pic', function () {
            var folder = $(this).data('folder');
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();

            form_data.append('file', file_data);
            form_data.append('folder', folder);
            $.each(thisClass.csrf, function (key) {
                form_data.append(key, thisClass.csrf[key]);
            });

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil file, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.upload,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    Swal.close();

                    if (response.success) {
                        thisClass.uploadHandler.afterAction(response);
                    } else {
                        Swal.fire('Error', response.error, 'error');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        })

        // source api get blue list
        $(document).on('click', '.blue-lite', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_blueLite",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('click', '.blue-test-period', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_blueTestPeriod",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('click', '.blue-last', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_blueLast",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('click', '.blue-rfid-last', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_bluerfidLast",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('click', '.spionam-last', function () {
            let $this = $(this);
            let data = { id: $this.data('id') }
            $.extend(data, thisClass.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function () {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: thisClass.url + "_spionamLast",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {
                    Swal.close();
                    if (result.success) {
                        $('#' + result.atr.modal_body).html(result.data)
                        $('#' + result.atr.modal).modal('toggle');
                    }
                },
                error: function () {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        });
    }

    loadDatatable(element, url, tableColumn, order = null) {
        var thisClass = this;

        var table = $('#' + element).DataTable({
            "autoWidth": false,
            "serverSide": true,
            "processing": true,
            "ordering": true,
            "order": order == null ? [[0, 'asc']] : order,
            "paging": true,
            "searching": { "regex": true },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "pageLength": 10,
            "searchDelay": 500,
            "ajax": {
                "type": "POST",
                "url": url,
                "dataType": "json",
                "data": function (data) {
                    // console.log(thisClass);
                    // Grab form values containing user options
                    dataStart = data.start;
                    let form = {};
                    Object.keys(data).forEach(function (key) {
                        form[key] = data[key] || "";
                    });

                    // Add options used by Datatables
                    let info = {
                        "start": data.start || 0,
                        "length": data.length,
                        "draw": 1
                    };

                    $.extend(form, info);
                    $.extend(form, thisClass.csrf);

                    return form;
                },
                "complete": function (response) {
                    // console.log(response);
                    feather.replace();
                }
            },
            "columns": thisClass.tableColumn
        }).on('init.dt', function () {
            // $(this).css('width','100%');
        });

        return table;
    }

    select2Init(id, url, placeholder, parameter, parent = null, selection = null) {
        var thisClass = this;

        if ($(id).data('select2')) {
            $(id).select2('destroy');
            thisClass.select2Init(id, url, placeholder, parameter, parent, selection);
        } else {
            console.log(id + " --> " + placeholder);
            var dt = $(id).select2({
                id: function (e) { return e.id },
                allowClear: true,
                placeholder: ((id == '#find_group_nm') ? 'Pilih Area Rute' : ''),
                //multiple: id=='#find_group_nm'?true:false,
                //minimumResultsForSearch: 1,
                //maximumSelectionLength:15,
                width: '100%',
                dropdownParent: parent == null ? $(document.body) : $(parent),
                ajax: {
                    url: thisClass.ajax + url,
                    dataType: 'json',
                    quietMillis: 500,
                    delay: 500,
                    data: function (param) {
                        var def_param = {
                            keyword: param.term, //search term
                            perpage: 5, // page size
                            page: param.page || 0, // page number
                        };


                        return Object.assign({}, def_param, parameter);
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 0
                        return {
                            results: data.rows,
                            pagination: {
                                more: false
                            }
                        }
                    }
                },
                templateResult: function (data) {
                    return data.text;
                },
                templateSelection: function (data) {
                    if (data.id == '') {
                        return placeholder;
                    }

                    if (selection !== null) { selection(data); }
                    return data.text;
                },
                escapeMarkup: function (m) {
                    return m;
                }
            });

            $(id).each(function (i, elm) {

                var id = $(elm).data('id');
                var text = $(elm).data('text');
                var $newOption = $('<option selected="selected"></optiol>').val(id).text(text);

                $(elm).append($newOption).trigger('change');
            });
        }
    }

    datepicker(element, fdata = 'dd/mm/yyyy', forientation = 'bottom') {
        $(element).datepicker({
            format: fdata,
            orientation: forientation
        }).on('changeDate', function () {
            $(this).datepicker('hide');
        });
    }
}

var F = function () {
    let f = {};

    String.prototype.reverse = function () {
        return this.split("").reverse().join("");
    }

    f.masking = (input) => {
        var x = input.value;
        x = x.replace(/\./g, ""); // Strip out all commas
        x = x.reverse();
        x = x.replace(/.../g, function (e) {
            return e + ".";
        }); // Insert new commas
        x = x.reverse();
        x = x.replace(/^\./, ""); // Remove leading comma

        input.value = x;
    }

    f.debounce = function (func, delay) {
        let debounceTimer
        return function () {
            const context = this
            const args = arguments
            clearTimeout(debounceTimer)
            debounceTimer
                = setTimeout(() => func.apply(context, args), delay)
        }
    }

    return f;
}()