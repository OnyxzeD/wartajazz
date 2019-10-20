// LAST UPDATE : 20171130

/******************************************************************************\
 Contains some functions that commonly used in some pages.
 There are some functions with certain postfix for certain purposes, :
 _init is for initiate when html page is loaded (direct url or via ajax)
 _set is to set input elements for certain plugin
 \******************************************************************************/


/******************************************************************************\
 By xekaiforce
 To help generate a BootStrap Modal (BM) and custom it from any selector
 ------------------------------------------------------------------------
 SELECTOR IS MEANT TO BE THE CONTENT,
 IT CREATES ANOTER ELEMENT, 'P' + SELECOR,
 MAKING IT AS THE ONE THAT BECOMES MODAL
 \******************************************************************************/
reopenModal = false; // SET TO TRUE whenever you're about to call modalMaker while another modal is still open
function x_BM_Gen(p) {
    // selector
    if (!p.selector)
        return;
    content = p.selector.substr(1);
    // Real Modal
    myModal = '#modal_' + content;
    // Hide all modal firstChil
    if ($('.modal').is(':visible')) {
        wait = true;
        $('.modal').modal('hide');
    }
    else {
        wait = false;
    }
    selector = p.selector;
    // Init, asumsi kalo blom ada class modal = harus di init
    if (!$(myModal).hasClass('modal')) {
        $(selector).wrap("	<div class=\"modal-body\"></div>");
        $(selector).parent().wrap("<div class=\"modal-content\"></div>");
        $(selector).parent().parent().wrap("<div class=\"modal-dialog\" role=\"document\"></div>");
        $(selector).parent().parent().parent().wrap("<div id=\"modal_" + content + "\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"></div>");
        $(selector).parent().before(
            "	<div class=\"modal-header\">\n" +
            "		<h5 class=\"modal-title\" id=\"myModalLabel\">" + p.title +
            "           <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"close\"><span aria-hidden=\"true\">&times;</span></button>" +
            "       </h5> " +
            "	</div>\n");
        $(selector).parent().after(
            "	<div class=\"modal-footer\">\n" +
            "		<button type=\"button\" class=\"btn btn-info saveBtn\"><i class=\"fa fa-check\"></i> Simpan</button>\n" +
            "		<button type=\"button\" class=\"btn btn-info okBtn\"><i class=\"fa fa-check\"></i> OK</button>\n" +
            "		<button type=\"button\" class=\"btn btn-danger closeBtn\" data-dismiss=\"modal\"><i class=\"fa fa-close\"></i> Batal</button>\n" +
            "	</div>\n");
        $(selector).show();
    }
    // size- Size of modal (lg: large, sm: small)
    $(myModal + ' > div').removeClass('modal-lg');
    $(myModal + ' > div').removeClass('modal-sm');
    if (p.size) {
        $(myModal + ' > div').addClass('modal-' + p.size);
    }
    // width, Custom Size in pixel (px)
    else if (p.width) {
        $(myModal + ' > div').attr('style', 'width:' + p.width);
    }
    else {
        $(myModal + ' > div').attr('style', 'width:600px;');
    }
    // contentFromElm - Body Content From Element
    if (p.contentFromElm) {
        $(myModal + ' .modal-body').html($(p.contentFromElm).html());
    }
    else if (p.contentVal) {
        $(myModal + ' .modal-body').html(p.contentVal);
    }
    // Footer
    $(myModal + ' .saveBtn').off('click');
    $(myModal + ' .okBtn').off('click');
    if (p.footerShow) {
        $(myModal + ' .modal-footer').show();
        if (p.saveBtn)
            $(myModal + ' .saveBtn').show();
        else
            $(myModal + ' .saveBtn').hide();
        if (p.okBtn)
            $(myModal + ' .okBtn').show();
        else
            $(myModal + ' .okBtn').hide();
    }
    else {
        $(myModal + ' .modal-footer').hide();
    }
    // ok button  click
    if (typeof p.okBtn_click == 'function') {
        $(myModal + ' .modal-footer .okBtn').click(function () {
            p.okBtn_click();
        });
    }
    // save button click
    if (typeof p.saveBtn_click == 'function') {
        $(myModal + ' .modal-footer .saveBtn').click(function () {
            p.saveBtn_click();
        });
    }
    // CallBack on Show
    if (typeof p.onShow == 'function')
        $(myModal).on('show.bs.modal', p.onShow());
    //
    if (!p.backdrop)
        backdrop = 'static';
    else
        backdrop = backdrop;

    // Go
    if (!wait) {
        $(myModal).modal({backdrop: backdrop});
    }
    else {
        $('.modal').on('hidden.bs.modal', function (e) {
            if (reopenModal) {
                $(myModal).modal({backdrop: backdrop});
                reopenModal = false; // Sementara pake ini dulu
            }
        });
    }
    // CallBack after Shown
    if (typeof p.onShown == 'function')
        $(myModal).on('shown.bs.modal', p.onShown());
    // CallBack on Hidden
    if (typeof p.onHidden == 'function')
        $(myModal).on('hidden.bs.modal', p.onHidden());
}


/******************************************************************************\
 By xekaiforce
 Standarize BM in submiting data (non ajax)
 \******************************************************************************/
function x_BM_GetForm_DirectSubmit(p) {
    //
    if (typeof p.selector == 'undefined')
        return;
    //
    if (p.getCurrentQueryString) {
        var urlQuery = document.location.search.substr(1);
        var urlQueryArr = urlQuery.split('&');
        var index, urlQueryAjax = '';
        for (index = 0; index < urlQueryArr.length; ++index) {
            component = urlQueryArr[index].split('=');
            urlQueryAjax += '&' + urlQueryArr[index];
        }
        if (p.cleanUrl)
            p.url += '?' + urlQueryAjax.substring(1);
        else
            p.url += urlQueryAjax;
    }
    //
    $.ajax({
        url: p.url,
        success: function (resp) {
            selector = p.selector;
            $(selector).html(resp);
            //
            if (typeof p.formId == 'string')
                formId = '#' + p.formId;
            else
                formId = '#MyForm';
            //
            if (p.footerShow !== false)
                footerShow = true;
            //
            if (p.okBtn !== false)
                okBtn = true;
            x_BM_Gen({
                selector: selector, size: p.size, width: p.width, title: p.title, footerShow: footerShow, okBtn: okBtn,
                okBtn_click: function () {
                    $(formId).trigger("submit");
                },
                saveBtn_click: function () {
                    $(formId).trigger("submit");
                },
                onShown: p.onShown
            });
        }
    });
}


/**********************************************************************\
 by xekaiforce
 help init modal for form submitting
 prereq = controller
 \**********************************************************************/
function x_BM_GetForm_DirectSubmit_Init() {
    $('.x_BM_GetForm_DirectSubmit').click(function () {
        // Get needs
        url = $(this).attr('x-url');
        getCurrentQueryString = $(this).attr('x-getcurrentquerystring');
        selector = $(this).attr('x-selector');
        title = $(this).attr('x-title');
        formId = $(this).attr('x-formid');
        width = $(this).attr('x-width');
        size = $(this).attr('x-size');
        footerShow = $(this).attr('x-footershow');
        okBtn = $(this).attr('x-okbtn');
        onShown = $(this).attr('x-onshown');
        preSubmit = $(this).attr('x-presubmit');
        postSubmit = $(this).attr('x-postsubmit');
        // Cek
        if (!selector)
            selector = '#FreeModal';
        //
        x_BM_GetForm_DirectSubmit({
            selector: selector,
            getCurrentQueryString: getCurrentQueryString,
            url: url,
            title: title,
            width: width,
            size: size,
            formId: formId,
            footerShow: footerShow,
            okBtn: okBtn,
            onShown: window[onShown],
            preSubmit: window[preSubmit],
            postSubmit: window[postSubmit]
        });
    });
}


/******************************************************************************\
 by xekaiforce
 to standarize getting form and submiting its data using ajax
 \******************************************************************************/
function x_BM_GetForm_AjaxSubmit(p) {
    //
    if (typeof p.selector == 'undefined')
        return;
    //
    $.ajax({
        url: p.targetUrl,
        success: function (resp) {
            selector = p.selector;
            $(selector).html(resp);
            modalSelector = '#modal_' + selector.substr(1) + ' .modal-content';
            //
            if (typeof p.formId == 'string')
                formId = '#' + p.formId;
            else
                formId = '#MyForm';
            //
            if (p.footerShow !== false && p.footerShow !== 'false')
                footerShow = true;
            else
                footerShow = false;
            //
            if (p.okBtn !== false && p.okBtn !== 'false')
                okBtn = true;
            else
                okBtn = false;
            //
            if (typeof p.postSubmitSelector == 'string')
                postSubmitSelector = p.postSubmitSelector;
            else
                postSubmitSelector = '';
            // Unbind all
            $(formId).off('submit');
            // Ajax biasa
            if (!p.ajaxForm) {
                $(formId).submit(function () {
                    //
                    // $(modalSelector).block();
                    $.blockUI();
                    //
                    if (typeof p.preSubmit == 'function') {
                        check = p.preSubmit();
                        if (check != true) {
                            $(modalSelector).unblock();
                            return false;
                        }
                    }
                    //
                    if (typeof tinyMCE == 'object' && $('.mce-tinymce').is(':visible')) {
                        tinyMCE.triggerSave();
                    }
                    //
                    $('.modal .x-msg').hide(100);
                    $.ajax({
                        url: p.submitUrl,
                        type: 'post',
                        data: $(formId).serialize(),
                        success: function (resp) {
                            if (typeof p.postSubmit == 'function') {
                                p.postSubmit(resp, postSubmitSelector);
                            }
                        }
                    }).always(function () {
                        $(modalSelector).unblock();
                        if (typeof p.always == 'function') {
                            p.always(resp);
                        }
                    });
                    return false;
                });
            }
            // Ajax jika ada file
            else {
                $(formId).ajaxForm({
                    beforeSerialize: function ($form, options) {
                        if (typeof tinyMCE == 'object' && $('.mce-tinymce').is(':visible')) {
                            tinyMCE.triggerSave();
                        }
                    },
                    beforeSubmit: function () {
                        $('.modal .x-msg').hide(100);
                        $(modalSelector).block();
                        //
                        if (typeof p.preSubmit == 'function') {
                            check = p.preSubmit();
                            if (check != true)
                                return false;
                        }
                    },
                    success: function (resp) {
                        if (typeof p.postSubmit == 'function') {
                            p.postSubmit(resp, postSubmitSelector);
                        }
                        $(modalSelector).unblock();
                    },
                    error: function () {
                        //$('.modal').modal('hide');
                        $(modalSelector).unblock();
                    }
                });
            }
            x_BM_Gen({
                selector: selector, size: p.size, width: p.width, title: p.title, footerShow: footerShow, okBtn: okBtn,
                okBtn_click: function () {
                    $(formId).trigger("submit");
                },
                saveBtn_click: function () {
                    $(formId).trigger("submit");
                },
                onShown: p.onShown
            });
        }
    });
}


/******************************************************************************\
 by xekaiforce
 helps initiate modal for form submitting via ajax
 prereq = controller
 \******************************************************************************/
function x_BM_GetForm_AjaxSubmit_Init(parentSelector) {
    if (!parentSelector)
        parentSelector = '';
    $(parentSelector + ' .x_BM_GetForm_AjaxSubmit').click(function () {
        // First check, if default action is set, then it uses current area + action
        defaultAction = $(this).attr('x-defaultaction');
        if (defaultAction) {
            if (Area != '')
                MyArea = Area + '/';
            else
                MyArea = '';
            targetUrl = baseurl + defaultAction + '/show';
            submitUrl = baseurl + defaultAction + '/submit';
        }
        else {
            targetUrl = $(this).attr('x-targeturl');
            submitUrl = $(this).attr('x-submiturl');
            if (!targetUrl)
                targetUrl = Controller;
            targetUrl = baseurl + targetUrl;
            if (!submitUrl)
                submitUrl = submitUrl;
            submitUrl = baseurl + submitUrl;
        }

        // Get needs
        title = $(this).attr('x-title');
        footerShow = $(this).attr('x-footershow');
        okBtn = $(this).attr('x-okbtn');
        size = $(this).attr('x-size');
        width = $(this).attr('x-width');
        onShown = $(this).attr('x-onshown');
        formId = $(this).attr('x-formid');
        ajaxForm = $(this).attr('x-ajaxform');
        preSubmit = $(this).attr('x-presubmit');
        postSubmit = $(this).attr('x-postsubmit');
        postSubmitSelector = $(this).attr('x-postsubmitselector');
        //
        x_BM_GetForm_AjaxSubmit({
            selector: '#FreeModal',
            targetUrl: targetUrl,
            submitUrl: submitUrl,
            title: title,
            size: size,
            width: width,
            formId: formId,
            ajaxForm: ajaxForm,
            footerShow: footerShow,
            okBtn: okBtn,
            onShown: window[onShown],
            preSubmit: window[preSubmit],
            postSubmit: window[postSubmit],
            postSubmitSelector: postSubmitSelector
        });
    });
}


/******************************************************************************\
 by xekaiforce
 to standarize form submiting data using ajax
 \******************************************************************************/
function x_BM_LocalForm_AjaxSubmit(p) {
    //
    if (typeof p.selector == 'undefined')
        return;
    //
    selector = p.selector;
    modalSelector = '#modal_' + selector.substr(1) + ' .modal-content';
    //
    if (typeof p.formId == 'string')
        formId = '#' + p.formId;
    else
        formId = '#MyForm';
    //
    if (p.footerShow !== false && p.footerShow !== 'false')
        footerShow = true;
    else
        footerShow = false;
    //
    if (p.okBtn !== false)
        okBtn = true;
    else
        okBtn = false;
    //
    if (typeof p.postSubmitSelector == 'string')
        postSubmitSelector = p.postSubmitSelector;
    else
        postSubmitSelector = '';
    // UNBIND ALL
    $(formId).off('submit');
    // Ajax biasa
    if (!p.ajaxForm) {
        $(formId).submit(function () {
            //
            $(modalSelector).block();
            //
            if (typeof p.preSubmit == 'function') {
                check = p.preSubmit();
                if (check != true) {
                    $(modalSelector).unblock();
                    return false;
                }
            }
            //
            if (typeof tinyMCE == 'object' && $('.mce-tinymce').is(':visible')) {
                tinyMCE.triggerSave();
            }
            //
            $('.modal .x-msg').hide(100);
            $.ajax({
                url: p.submitUrl,
                type: 'post',
                data: $(formId).serialize(),
                success: function (resp) {
                    if (typeof p.postSubmit == 'function') {
                        p.postSubmit(resp, postSubmitSelector);
                    }
                }
            }).always(function () {
                $(modalSelector).unblock();
                if (typeof p.always == 'function') {
                    p.always(resp);
                }
            });
            return false;
        });
    }
    // Ajax jika ada file
    else {
        $(formId).ajaxForm({
            beforeSerialize: function ($form, options) {
                if (typeof tinyMCE == 'object' && $('.mce-tinymce').is(':visible')) {
                    tinyMCE.triggerSave();
                }
            },
            beforeSubmit: function () {
                $('.modal .x-msg').hide(100);
                $(modalSelector).block();
                //
                if (typeof p.preSubmit == 'function') {
                    check = p.preSubmit();
                    if (check != true)
                        return false;
                }
            },
            success: function (resp) {
                if (typeof p.postSubmit == 'function') {
                    p.postSubmit(resp, postSubmitSelector);
                }
                $(modalSelector).unblock();
            },
            error: function () {
                //$('.modal').modal('hide');
                $(modalSelector).unblock();
            }
        });
    }
    x_BM_Gen({
        selector: selector, size: p.size, width: p.width, title: p.title, footerShow: footerShow, okBtn: okBtn,
        okBtn_click: function () {
            $(formId).trigger("submit");
        },
        saveBtn_click: function () {
            $(formId).trigger("submit");
        },
        onShown: p.onShown
    });
}


/******************************************************************************\
 by xekaiforce
 helps initiate modal for form submitting via ajax
 prereq = controller
 \******************************************************************************/
function x_BM_LocalForm_AjaxSubmit_Init(parentSelector) {
    if (!parentSelector)
        parentSelector = '';
    $(parentSelector + ' .x_BM_LocalForm_AjaxSubmit').click(function () {
        selector = $(this).attr('x-selector');
        if (!selector)
            return;
        // First check, if default action is set, then it uses current area + action
        defaultAction = $(this).attr('x-defaultaction');
        if (defaultAction) {
            if (Area != '')
                MyArea = Area + '/';
            else
                MyArea = '';
            submitUrl = baseurl + MyArea + Controller + '/submit' + defaultAction;
        }
        else {
            submitUrl = $(this).attr('x-submiturl');
            if (!submitUrl)
                submitUrl = submitUrl;
            submitUrl = baseurl + submitUrl;
        }

        // Get needs
        title = $(this).attr('x-title');
        footerShow = $(this).attr('x-footershow');
        okBtn = $(this).attr('x-okbtn');
        size = $(this).attr('x-size');
        width = $(this).attr('x-width');
        onShown = $(this).attr('x-onshown');
        formId = $(this).attr('x-formid');
        ajaxForm = $(this).attr('x-ajaxform');
        preSubmit = $(this).attr('x-presubmit');
        postSubmit = $(this).attr('x-postsubmit');
        postSubmitSelector = $(this).attr('x-postsubmitselector');
        //
        x_BM_LocalForm_AjaxSubmit({
            selector: selector,
            submitUrl: submitUrl,
            title: title,
            size: size,
            width: width,
            formId: formId,
            ajaxForm: ajaxForm,
            footerShow: footerShow,
            okBtn: okBtn,
            onShown: window[onShown],
            preSubmit: window[preSubmit],
            postSubmit: window[postSubmit],
            postSubmitSelector: postSubmitSelector
        });
    });
}


// INI AKAN DRPRECATED
function x_PostSubmit_Default(resp) {
    if (resp.Status == 'success') {
        $('.modal').modal('hide');
        window.location.reload();
    }
    else {
        $('.modal .x-msg').show(100);
        $('.modal .x-msg').html(resp.Msg);
    }
}

// DIGANTI INI
function x_BM_PostSubmit_Default(resp) {
    if (resp.Status == 'success') {
        if (typeof resp.Msg == 'string') {
            $('.modal-body').html(resp.Msg);
        }
        else {
            $('.modal-body').html('<h5><i class="fa fa-check"></i> PROSES BERHASIl</h5>');
        }
        $('.modal').modal('hide');
        window.location.reload();
    }
    else {
        $('.modal .x-msg').show(100);
        $('.modal .x-msg').html(resp.Msg);
    }
}

function x_BM_PostSubmit_Page(resp, selector) {
    $('.modal').modal('hide');
    $(selector).html(resp);
    x_BM_GetForm_AjaxSubmit_Init(selector);
}

/******************************************************************************\
 Ajax ation init
 \******************************************************************************/
function x_BM_AjaxPagination_Init() {
    $('.pagination a').click(function () {
        $.ajax({
            url: $(this).attr('href'),
            success: function (resp) {
                $('.modal-body > div').html(resp);
                x_AjaxActionBase_Init();
            }
        });
        return false;
    });
}


/******************************************************************************\
 by xekaiforce
 helps initiate table for deletation function
 \******************************************************************************/
function x_Record_DelConfirm_Init() {
    $('.record .delete').click(function () {
        // Generate content
        id = $(this).attr('x-id');
        targetUrl = $(this).attr('x-targeturl');
        content = '';
        $('#DataHeader .DataInfo').each(function () {
            key = $(this).attr('x-key');
            content += '<tr> <td>' + $(this).html() + ' &nbsp; </td> <td>:</td> <td>' + $('#Record_' + id + ' .' + key).html() + '</td> </tr>';
        });
        content =
            'Sistem akan menghapus data dengan keterangan sebagai berikut ' +
            '<table cellspacing="0" cellpadding="0" class="table-information mg_top_10 mg_bot_20"> ' +
            '<colgroup> <col /> <col style="width:10px;"/> <col /> </colgroup> ' +
            '<tbody> ' + content + '</tbody> ' +
            '</table> ' +
            'Lanjutkan Proses?';
        $('#FreeModal').html(content);
        // Generate Modal
        size = $(this).data('size');
        if (!size)
            size = '600px';
        x_BM_Gen({
            selector: '#FreeModal', title: 'Hapus Data', cust_size: size, footerShow: true,
            okBtn: true,
            okBtn_click: function () {
                $.ajax({
                    url: baseurl + targetUrl + id,
                    success: function (resp) {
                        if (resp.Status == 'success')
                            location.reload();
                    }
                });
            }
        });
    });
}


/******************************************************************************\
 by xekaiforce
 helps initiate in changing hash for anchor tag (<a>)
 \******************************************************************************/
function x_aHashChange_Init() {
    $('a.HashCange').click(function () {
        original = window.location.href.split('#');
        window.location = original[0] + $(this).attr('href');
    });
}

/******************************************************************************\
 by xekaiforce
 helps initiate in in hash changing  on tab
 \******************************************************************************/
function x_HashTab_Init() {
    hash = window.location.hash.slice(1);
    if (hash) {
        $('#' + hash + 'tab').tab('show');
    }
    else {
        $('.x_AjaxTabs .TabIndex:first').tab('show');
    }
}

/******************************************************************************\
 by xekaiforce
 helps initiate in getting content from shown tab if its empty
 \******************************************************************************/
function x_AjaxTabs_Init() {
    $('.x_AjaxTabs .TabIndex').on('shown.bs.tab', function (e) {
        // e.target // newly activated tab
        // e.relatedTarget // previous active tab
        defaultAction = $(this).attr('x-defaultaction');
        targetContainer = $(this).attr('href');

        content = $(targetContainer).html().trim();
        if (content != '')
            return;

        if (Area != '')
            MyArea = Area + '/';
        else
            MyArea = '';

        if (defaultAction) {
            targetUrl = baseurl + MyArea + Controller + '/show' + defaultAction;
        }
        else {
            targetUrl = $(this).attr('x-targeturl');
            if (targetUrl) {
                targetUrl = baseurl + targetUrl;
            }
            else {
                targetUrl = baseurl + MyArea + Controller + '/show' + targetContainer.substring(1);
            }
        }

        $.ajax({
            url: targetUrl,
            success: function (resp) {
                $(targetContainer).html(resp);
                x_BM_GetForm_AjaxSubmit_Init();
            }
        });
    })
}


/******************************************************************************\
 by xekaiforce
 Make select chainable
 \******************************************************************************/
function x_Select_Chained(getDataUrl, sourceSelector, targetSelector, autoHideTarget) {
    if (autoHideTarget && !$(sourceSelector).val()) {
        $(targetSelector + 'box').hide();
        $(targetSelector).val('');
        $(targetSelector).trigger('change');
    }

    param = '';
    params = $(sourceSelector).val().toString().split(',');
    for (var i in params) {
        param += 'val[]=' + params[i] + '&';
    }

    $.ajax({
        url: baseurl + getDataUrl + '/?' + param.substring(0, param.length),
        dataType: 'json',
        success: function (resp) {
            if (resp.status == 'success') {
                options = '';
                data = resp.data;
                for (var key in data) {
                    options += '<option value="' + key + '">' + data[key] + '</option>';
                }
                $(targetSelector + 'box').show();
                $(targetSelector).html(options);
                $(targetSelector).trigger('change');
            }
        }
    });
}

function x_Select_Chained_Set() {
    $('.x_Select_Chained').change(function () {
        getDataUrl = $(this).attr('x-getdataurl');
        sourceSelector = '#' + $(this).attr('id');
        targetSelector = $(this).attr('x-targetselector');
        autoHideTarget = $(this).attr('x-autohidetarget');
        x_Select_Chained(getDataUrl, sourceSelector, targetSelector, autoHideTarget);
    });

}

/******************************************************************************\
 Default cek form
 \******************************************************************************/
function DefaultFormCheck() {
    $('input.numeric').each(function () {
        $(this).data('val', $(this).val());
    });
    $('input.numeric').keyup(function () {
        // Cek Awal
        val = $(this).val();
        if (/^\d*\.?\d*$/.test(val)) {
            $(this).data('val', val);
        }
        else {
            $(this).val($(this).data('val') || '');
        }
        // Untuk next check
        val = $(this).val();
        // Cek Min
        Limit = $(this).attr('min');
        if (Limit && (parseInt(val) < parseInt(Limit))) {
            $(this).val(Limit);
        }
        // Cek Max
        Limit = $(this).attr('max');
        if (Limit && (parseInt(val) > parseInt(Limit))) {
            $(this).val(Limit);
        }
    });
}


/*
 snipet for datetimepicker
 class : dateTimePicker-field + datePicker-field
 */
function dateTimePicker_Set(format) {
    if (!$.isFunction($.fn.datetimepicker)) {
        console.log('datetimepicker is not loaded');
        return;
    }
    $('.dateTimePicker-field, .datePicker-field').each(function () {
        $(this).attr('data-toggle', 'datetimepicker');
        $(this).attr('data-target', '#' + $(this).attr('id'));
    });
    format = format || "DD MMMM YYYY";

    $('.dateTimePicker-field').datetimepicker({
        Default: false,
        locale: 'id',
        format: 'HH:mm'
    });

    $('.datePicker-field').datetimepicker({
        useCurrent: false,
        locale: 'id',
        minDate: startDate,
        maxDate: maxDate,
        format: format,
        daysOfWeekDisabled: [0, 6]
    });
}

function datepicker() {
    $('.input-group.date').datepicker({
        calendarWeeks: true,
        autoclose: true,
        beforeShowDay: function (date) {
            if (date.getMonth() == (new Date()).getMonth())
                switch (date.getDate()) {
                    case 4:
                        return {
                            tooltip: 'Example tooltip',
                            classes: 'active'
                        };
                    case 8:
                        return false;
                    case 12:
                        return "green";
                }
        },
        toggleActive: true
    });
}

/*
 snipet for tinymce
 set class .tinyMCE-field as editor and give customstandard for the theme.
 inline is set to true
 additional event(s) of tinyMCE is given as parameter just incase its needed
 class : tinyMCE-field
 */
function tinyMCE_Set(events) {
    if (typeof window['tinymce_create'] != 'function') {
        console.log('tinymce is not loaded');
        return;
    }
    tinymce_create('.tinyMCE-field', 'customstandard', null, events)
}

/*
 snipet for file
 class : file
 */
function fileInput_Set() {

    if (!$.isFunction($.fn.fileinput)) {
        console.log('fileinput is not loaded');
        return;
    }
    $("#file").fileinput({
        maxFileCount: 1,
        allowedFileExtensions: ["jpg", "png"],
        showUpload: false
    });
}


/******************************************************************************\
 Form Full init
 \******************************************************************************/
function formFull_Set() {
    dateTimePicker_Set();
    tinyMCE_Set();
    fileInput_Set();
    x_Select_Chained_Set();
}


/******************************************************************************\
 Search Init
 \******************************************************************************/
function AddSearch(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)", "i");
    if (value === undefined) {
        if (uri.match(re)) {
            return uri.replace(re, '$1$2');
        } else {
            return uri;
        }
    } else {
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            var hash = '';
            if (uri.indexOf('#') !== -1) {
                hash = uri.replace(/.*#/, '#');
                uri = uri.replace(/#.*/, '');
            }
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            return uri + separator + key + "=" + value + hash;
        }
    }
}

function Search() {
    $("#SeachForm").submit(function (event) {
        set = window.location.pathname;
        var url = null;
        if (set == "/") {
            url = '/product'
        }
        else if (!set.includes("/product")) {
            url = '/product'
        }
        else if (set.includes("/product/c")) {
            url = window.location.pathname;
        }
        else {
            url = '/product'
        }
        /*else if(set != "/"){
         url = window.location.pathname;
         }
         else if(set != "/"){
         url = window.location.pathname;
         }*/
        /*else if(set == "//"){
         url = '/product'
         }*/
        var val = $('#Search').val();
        var Condition = 'search';
        console.log("aaa" + val);
        console.log(url);
        var setUrl = AddSearch(url, Condition, val);
        window.location.href = setUrl;
        event.preventDefault();
    });
}


/******************************************************************************\
 Ajax ation init
 \******************************************************************************/
function x_AjaxAction_Init() {
    $('.x_AjaxAction').on('click', function () {
        // Action
        defaultAction = $(this).attr('x-defaultaction');
        if (defaultAction) {
            if (Area != '')
                MyArea = Area + '/';
            else
                MyArea = '';
            targetUrl = baseurl + MyArea + Controller + '/' + defaultAction;
        }
        else {
            url = $(this).attr('x-url');
            submitUrl = baseurl + url;
        }

        // Lain2
        preAcion = $(this).attr('x-preaction');
        postAction = $(this).attr('x-postaction');
        selector = $(this).attr('x-selector');

        // Other attr
        if (typeof window[preAcion] == 'function') {
            check = p.preAcion();
            if (check != true) {
                $(modalSelector).unblock();
                return false;
            }
        }

        // Go
        $.ajax({
            url: url,
            success: function (resp) {
                if (typeof window[postAction] == 'function') {
                    window[postAction](resp, selector);
                }
                else if (postAction == 'reinit') {
                    $(elSelector).html(resp);
                    x_AjaxAction_Init();
                }
                else if (postAction == 'reload') {
                    if (resp.Status == 'success')
                        window.location.reload();
                }
            }
        });
        return false;
    });
}

function x_AjaxAction_PostAction_Default() {

}

/******************************************************************************\
 Ajax submit init
 \******************************************************************************/
function x_AjaxSubmit_Init() {
    $('.x_AjaxSubmit').on('submit', function () {
        // Action
        defaultAction = $(this).attr('x-defaultaction');
        if (defaultAction) {
            if (Area != '')
                MyArea = Area + '/';
            else
                MyArea = '';
            targetUrl = baseurl + MyArea + Controller + '/' + defaultAction;
        }
        else {
            url = $(this).attr('x-url');
            submitUrl = baseurl + url;
        }

        // Lain2
        preAcion = $(this).attr('x-preaction');
        postAction = $(this).attr('x-postaction');
        selector = $(this).attr('x-selector');

        // Other attr
        if (typeof window[preAcion] == 'function') {
            check = p.preAcion();
            if (check != true) {
                $(modalSelector).unblock();
                return false;
            }
        }

        // Go
        $.ajax({
            url: url,
            data: $(this).serialize(),
            success: function (resp) {
                if (typeof window[postAction] == 'function') {
                    window[postAction](resp, selector);
                }
                else if (postAction == 'reinit') {
                    $(elSelector).html(resp);
                    x_AjaxAction_Init();
                }
                else if (postAction == 'refresh') {
                    window.location.reload();
                }
            }
        });
        return false;
    });
}

function x_AjaxSubmit_PostSubmit_Default() {

}

function x_AjaxActionBase_Init() {
    x_BM_AjaxPagination_Init();
    x_AjaxAction_Init();
}


/******************************************************************************\
 Custom function by OnyxzeD
 \******************************************************************************/
// validate number input
function validateNumber(e) {
    if ($.inArray(e.keyCode, [8, 9, 35, 36, 37, 38, 39, 40, 46]) !== -1 || e.ctrlKey === true ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

// pagination in modal
function modalPaging() {
    $('li').on('click', '>a', function (e) {
        e.preventDefault();  // prevent default behaviour for anchor tag
        var page_url;
        if ($(this).attr('data-ci-pagination-page') == 1) {
            page_url = $(this).attr('href') + '1'; // getting href of <a> tag
        } else {
            page_url = $(this).attr('href'); // getting href of <a> tag
        }
        getData(page_url);
    });

    if (parseInt($("input[name='totalData']").val()) == 0) {
        $("#tambahPerusahaan").show('slow');
    } else {
        $("#tambahPerusahaan").hide('slow');
    }
}

// get data for pagination
function getData(page_url) {
    currentRequest = $.ajax({
        url: page_url + '?Cari=' + $("input[name='Cari']").val(),
        beforeSend: function () {
            if (currentRequest != null) {
                currentRequest.abort();
            }
        },
        success: function (ajax) {
            $('#modal_content').html(ajax);
        }
    });
}

// choose item from modal
function choose(elem, value1, value2) {
    $("input[name='" + elem + "_Id']").val(value1);
    $("input[name='" + elem + "_Nomor']").val(value2);
}


/*
 All init
 */
$(document).ready(function () {
    Search();
    x_BM_GetForm_DirectSubmit_Init();
    x_BM_GetForm_AjaxSubmit_Init();
    x_BM_LocalForm_AjaxSubmit_Init();
    x_aHashChange_Init();
    x_Record_DelConfirm_Init();
    x_AjaxTabs_Init();
    x_HashTab_Init();
});
