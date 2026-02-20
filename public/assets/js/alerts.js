"use strict";

/**
 * ALERT PADRÃO DO SISTEMA
 */
function showAlert(type, title, message) {
    Swal.fire({
        icon: type,
        title: title,
        text: message,
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
    });
}

/**
 * ALERT DE CONFIRMAÇÃO
 */
function confirmAction(message, callback) {
    Swal.fire({
        title: "Confirmar ação?",
        text: message,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed && typeof callback === "function") {
            callback();
        }
    });
}

/**
 * ALERT TOAST (canto superior)
 */
function toast(type, message) {
    Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    }).fire({
        icon: type,
        title: message,
    });
}
