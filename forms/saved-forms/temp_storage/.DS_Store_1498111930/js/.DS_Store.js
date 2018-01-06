$(document).ready(function(){$.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-z]+$/i.test(value);
                });
                $('#.DS_Store_1498111930').validate({errorPlacement: function(error, element) {
                            if (element.attr("type") == "checkbox") {
                                error.insertAfter(element.closest(".checkbox"));
                            } else if (element.attr("type") == "radio") {
                                error.insertAfter(element.closest(".radio"));
                            } else if (element.attr("input_type") == "rating") {
                                error.insertAfter(element.closest(".error_place"));
                            } else if (element.parent(".input-group").length) {
                                error.insertAfter(element.parent());
                            } else {
                                error.insertAfter(element);
                            }
                        },
                    highlight: function(element) {
                        $(element).closest(".form-group").addClass("has-error_.DS_Store_1498111930");
                    },
                    unhighlight: function(element) {
                        $(element).closest(".form-group").removeClass("has-error_.DS_Store_1498111930");
                    },
                    errorClass: "error-class_.DS_Store_1498111930",
                    submitHandler: function (form) {
                        var $btn = $(form).find(".send_email").button("loading");
                        $.ajax({
                            type: $('#.DS_Store_1498111930').attr('method'),
                            url: $('#.DS_Store_1498111930').attr('action'),
                            data: $(form).serialize(),
                            dataType: "json",
                            success: function (result) {
                                $btn.button("reset");
                                
                                if(result.success == 1){
                                    if (typeof .DS_Store_success_true === "function") {
                                        .DS_Store_success_true(result);
                                    }
                                    if( result.redirect == 1 ){
                                        window.location = result.url;
                                    } else {
                                        var html = '<div class="alert alert-dismissable alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + result.msg + '</div>';
                                        $(form).find( "#msg" ).html(html);
                                        $(form)[0].reset();
                                    }
                                } else {
                                    if (typeof .DS_Store_success_false === "function") {
                                        .DS_Store_success_false(result);
                                    }
                                    var html = '<div class="alert alert-dismissable alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + result.msg + '</div>';
                                    $(form).find( "#msg" ).html(html);
                                }
                            }
                        });
                        return false;
                    }
                });
            });
        