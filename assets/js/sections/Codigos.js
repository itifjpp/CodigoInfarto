$(document).ready(function (e) {
    $('.form-codigos-agregar').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Sections/Codigos/AjaxAgregar',function (response) {
            window.top.close();
            window.opener.location.reload();
        });
    });
    $('.form-codigos-agregar-f1').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Sections/Codigos/AjaxAgregarF1',function (response) {
            window.top.close();
            window.opener.location.reload();
        });
    });
    $('.form-codigos-agregar-f2').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Sections/Codigos/AjaxAgregarF2',function (response) {
            window.top.close();
            window.opener.location.reload();
        });
    });
    $('.form-codigos-agregar-f3').submit(function (e) {
        e.preventDefault();
        SendAjaxPost($(this).serialize(),'Sections/Codigos/AjaxAgregarF3',function (response) {
            window.top.close();
            window.opener.location.reload();
        });
    });
});
