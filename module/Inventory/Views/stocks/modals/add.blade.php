<div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Add Stocks</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
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
                <form method="POST" action="{{ route('store_stocks') }}" id="kt_modal_add_permission_form" class="form">
                    @csrf
                    <div class="mb-5">
                        <label class="form-label required">Select Category</label>
                        <select onchange="categoryName()" id="category_name" name="category_name" class="form-select form-select-solid" data-control="select2" data-placeholder="Select product category">
                            <option></option>
                            <option value="seed">Seed</option>
                            <option value="agrochemicals">Agrochemicals</option>
                        </select>
                    </div>

                    <div id="stockContainer">
                        <template id="pair-template">
                            <div class="row mb-2 pair-group">
                                <div class="col-md-7">
                                    <select id="product_id" name="product_id[]" class="product-select form-select form-select-solid" data-control="select2" data-placeholder="Select products">
                                        
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <!--begin::Input-->
                                    <input class="no-spinner form-control form-control-solid" placeholder="Type quantity" name="quantity[]" type="number" autocomplete="off" />
                                    <!--end::Input-->
                                </div>
                            </div>
                        </template>
                    </div>


                    <h6><a href="javascript:void(0);" type="button" onclick="addPair()">+ Add More Stock</a></h6>

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" onclick="addSalePointForm(this)">
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
    let productOptions = '';

    function categoryName() {
        let selectedCategory = $('#category_name').find('option:selected').val();
        let action = "{{ route('catalog.products_by_category_name') }}" + '?category_name=' + encodeURIComponent(selectedCategory);

        $.ajax({
            url: action,
            method: 'GET',
            success: function (data) {
                console.log(data);

                productOptions = '<option></option>';
                $.each(data.products, function (key, product) {
                    productOptions += '<option value="' + product.id + '">' + product.title + '</option>';
                });

                $('.product-select').each(function () {
                    $(this).html(productOptions).trigger('change');
                });

                $('.product-select').select2({
                    dropdownParent: $('#kt_modal_add_permission')
                });
            },
            error: function (error) {
                console.log('Error fetching products data:', error);
            }
        });
    }

    function addPair() {
        const container = document.getElementById('stockContainer');
        const template = document.getElementById('pair-template');

        // Use HTMLTemplateElement's content to clone clean DOM
        const clone = document.importNode(template.content, true);
        const $clone = $(clone);

        $clone.find('.product-select').html(productOptions);

        container.appendChild($clone[0]);

        // Re-initialize Select2 on the newly added select
        $('#stockContainer').find('select[data-control="select2"]').select2({
            dropdownParent: $('#kt_modal_add_permission')
        });
    }

    function addSalePointForm(button) {
        let form = $('#kt_modal_add_permission_form');
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

                $('#kt_modal_add_permission').modal('hide');

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