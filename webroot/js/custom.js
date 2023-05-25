const MODAL_SIZE = {
    SMALL: "modal-sm",
    DEFAULT: "",
    LARGE: "modal-lg",
    XL: "modal-xl",
};

const TOAST_TYPE = {
    ERROR: "error",
    SUCCESS: "success",
};

const TOAST_TIMER = 1000;

function after(timeout, callback) {
    setTimeout(() => {
        callback();
    }, timeout);
}

function showToast(type, message) {
    Swal.fire({
        icon: type,
        title: message,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: TOAST_TIMER,
    });
}

function showModal(options = {}, element = "#modal-default") {
    let $modal = $("#modal-default");

    // unbind all click events;
    $modal.find("#button-close").unbind("click");
    $modal.find("#button-submit").unbind("click");

    $modal.close = () => {
        $modal.find("#button-close").click();
    };

    if (options.submitButton !== undefined && options.submitButton !== false) {
        $modal.find("#button-submit").removeClass("d-none");
        $modal.find("#button-submit").text(options.submitButton);
    } else $modal.find("#button-submit").addClass("d-none");

    if (options.title !== undefined)
        $modal.find("#modal-title").text(options.title);

    if (options.size !== undefined) {
        $.each(Object.keys(MODAL_SIZE), function (i, v) {
            $modal.find(".modal-dialog").removeClass(MODAL_SIZE[v]);
        });
        $modal.find(".modal-dialog").addClass(options.size);
    }
    let content = "";

    if (options.src !== undefined) {
        let contentFromAjax = new Promise((resolve, reject) => {
            $.ajax({
                url: options.src,
                type: "GET",
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                },
            });
        });
        contentFromAjax.then((data) => {
            $modal.find("#modal-body").html(data);
        });
    } else {
        $modal.find("#modal-body").html(content);
    }

    $modal.find("#button-submit").click(() => {
        let form = $modal.find("#modal-body").find("form")[0];
        let formData = new FormData(form);
        let action = $(form).attr("action");
        let method = $(form).attr("method");

        $.ajax({
            type: method ?? "POST",
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (!response.success) {
                    showToast(TOAST_TYPE.ERROR, response.message);
                    if (response.content != []) {
                        $modal.find("#form-message").html(response.content);
                    }
                } else {
                    showToast(TOAST_TYPE.SUCCESS, response.message);
                }

                options.onSubmit($modal, response);
            },
            error: function (error) {},
        });
    });

    $modal.modal("show");
}
