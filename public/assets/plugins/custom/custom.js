(function ($) {
    "use strict";

    /** confirm modal start */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".checkAll").on("click", function () {
        $("input:checkbox").not(this).prop("checked", this.checked);
    });

    if ($("#selectAll").length > 0) {
        // Select All checkbox click
        const selectAll = document.querySelector("#selectAll"),
            checkboxList = document.querySelectorAll('[type="checkbox"]');
        selectAll.addEventListener("change", (t) => {
            checkboxList.forEach((e) => {
                e.checked = t.target.checked;
            });
        });
    }

    $('.d-none.image-input').on('change', function() {
        var parent_node = $(this).parent().attr('class');
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.'+parent_node + ' img').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(".term-cat-modal").on("click", function () {
        const url = $(this).data("url");
        const title = $(this).data("title");
        const status = $(this).data("status");
        const class_name = $(this).data("class_name");
        const link = $(this).data("link");
        $(".title").val(title);
        $(".status").val(status);
        $(".class_name").val(class_name);
        $(".link").val(link);
        $("#term-cat-modal").modal("show");
        $(".term-edit-form").attr("action", url);
    });


    $(".sub-news-category-modal").on("click", function () {
        var url = $(this).data("url");
        var name = $(this).data("name");
        var status = $(this).data("status");
        $(".name").val(name);
        $(".status").val(status);
        $("#sub-news-category-modal").modal("show");
        $(".sub-news-category-edit-form").attr("action", url);
    });

    $(".skill-modal").on("click", function () {
        var url = $(this).data("url");
        var name = $(this).data("name");
        var percent = $(this).data("percent");
        var status = $(this).data("status");
        $(".name").val(name);
        $(".percent").val(percent);
        $(".status").val(status);
        $("#skill-modal").modal("show");
        $(".skill-edit-form").attr("action", url);
    });

    $(".service-modal").on("click", function () {
        var url = $(this).data("url");
        var name = $(this).data("name");
        var status = $(this).data("status");
        $(".name").val(name);
        $(".status").val(status);
        $("#service-modal").modal("show");
        $(".service-edit-form").attr("action", url);
    });

    $(".portfolio-modal").on("click", function () {
        var url = $(this).data("url");
        var title = $(this).data("title");
        var status = $(this).data("status");
        $(".title").val(title);
        $(".status").val(status);
        $("#portfolio-modal").modal("show");
        $(".portfolio-edit-form").attr("action", url);
    });

    $(".news-cat-modal").on("click", function () {
        var url = $(this).data("url");
        var name = $(this).data("name");
        var status = $(this).data("status");
        $(".name").val(name);
        $(".status").val(status);
        $("#news-cat-modal").modal("show");
        $(".news-cat-edit-form").attr("action", url);
    });


    $(".experiences-modal").on("click", function () {
        var url = $(this).data("url");
        var title = $(this).data("title");
        var date = $(this).data("date");
        var status = $(this).data("status");
        var description = $(this).data("description");
        $(".title").val(title);
        $(".date").val(date);
        $(".status").val(status);
        $(".description").val(description);
        $("#experiences-modal").modal("show");
        $(".experiences-edit-form").attr("action", url);
    });

    $(".tagline-modal").on("click", function () {
        var url = $(this).data("url");
        var name = $(this).data("name");
        var status = $(this).data("status");
        $(".name").val(name);
        $(".status").val(status);
        $("#tagline-modal").modal("show");
        $(".tagline-edit-form").attr("action", url);
    });

    $(".special-modal").on("click", function () {
        var url = $(this).data("url");
        var title = $(this).data("title");
        var status = $(this).data("status");
        $(".title").val(title);
        $(".status").val(status);
        $("#special-modal").modal("show");
        $(".special-edit-form").attr("action", url);
    });


    $(".lang-edit-modal").on("click", function () {
        const url = $(this).data("url");
        const name = $(this).data("name");
        const code = $(this).data("code");
        const status = $(this).data("status");
        $(".name").val(name);
        $(".code").val(code);
        $(".status").val(status);
        $("#lang-edit-modal").modal("show");
        $(".lang-edit-form").attr("action", url);
    });

    $(".delete-confirm").on("click", function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        let method = $(this).data('method') ?? 'DELETE';
        let icon = $(this).data('icon') ?? 'bx bxs-x-circle';

        $.confirm({
            title: "Heads Up!",
            icon: icon,
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            buttons: {
                confirm: {
                    btnClass: 'btn-red',
                    action: function () {
                        event.preventDefault();
                        $.ajax({
                            type: method,
                            url: url,
                            success: function (response) {
                                if (response.redirect) {
                                    window.sessionStorage.hasPreviousMessage = true;
                                    window.sessionStorage.previousMessage = response.message ?? null;

                                    location.href = response.redirect;
                                } else {
                                    Notify('success', response)
                                }
                            },
                            error: function (xhr, status, error) {
                                Notify('error', xhr)
                            }
                        })
                    }
                },
                close: {
                    action: function () {
                        this.buttons.close.hide()
                    }
                }
            },
        });
    });
})(jQuery);
