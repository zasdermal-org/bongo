<div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Add Product</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" action="{{ route('catalog.store_product') }}" class="form" id="kt_modal_add_product_form">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required form-label">Select a Category</label>
                            <!--end::Label-->
                            
                            <!--begin::Select2-->
                            <select onchange="category()" id="category_id" name="category_id" data-dropdown-parent="#kt_modal_add_product" class="form-select mb-2" data-control="select2" data-placeholder="Select a category">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="sub_category_div" style="display: none;">
                            <!--begin::Label-->
                            <label class="required form-label">Select a Sub Category</label>
                            <!--end::Label-->

                            <!--begin::Select2-->
                            <select id="sub_category_id" name="sub_category_id" data-dropdown-parent="#kt_modal_add_product" class="form-select mb-2" data-control="select2" data-placeholder="Select a sub category">
                                <!--option will be populated from ajax request-->
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required form-label">Product Name</label>
                            <!--end::Label-->
                            
                            <!--begin::Input-->
                            <input type="text" name="title" class="form-control mb-2" placeholder="Product name" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required form-label">Unit Price</label>
                            <!--end::Label-->
                            
                            <!--begin::Input-->
                            <input type="number" name="unit_price" class="no-spinner form-control mb-2" placeholder="Product price" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required form-label">SKU</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Discard</button>

                        <button type="submit" class="btn btn-primary" onclick="addProductForm(this)">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<script>
    function category() {
        let url = "{{ route('catalog.subCategories_by_category_', ['id' => ':category_id']) }}";
        let category_id = $('#category_id').val();
        let action = url.replace(':category_id', category_id);

        $('#sub_category_id').empty();

        if (category_id !== "") {
            $.ajax({
                url: action,
                method: 'GET',
                success: function (data) {
                    $('#sub_category_id').append('<option></option>');
                    $.each(data.sub_categories, function (key, sub_category) {
                        $('#sub_category_id').append('<option value="' + sub_category.id + '">' + sub_category.name + '</option>');
                    });

                    $('#sub_category_div').show();
                },
                error: function (error) {
                    console.log('Error fetching sub categories data:', error);
                }
            });
        } else {
            $('#sub_category_div').hide();
        }
    }

    function addProductForm(button) {
        let form = $('#kt_modal_add_product_form');
        let url = form.attr('action');

        // Disable the button and show loading
        $(button).prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm align-middle me-2"></span>Submitting...'
        );

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function (response) {
                toastr.success(response.message);

                $('#kt_modal_add_product').modal('hide');

                setTimeout(function () {
                    location.reload();
                }, 1500); // 1 second delay
            },
            error: function (xhr) {
                $('.text-danger').remove(); // Remove previous errors

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = form.find('[name="' + key + '"]');
                        input.before('<div class="text-danger mb-1">' + messages[0] + '</div>');
                    });
                } else {
                    toastr.error('Something went wrong');
                }
            },
            complete: function () {
                // Re-enable the button
                $(button).prop('disabled', false).html('Submit');
            }
        });
    }
</script>