@extends('frontend.layout.master')

@section('content')
<h3>All Products</h3>

<div class="row" id="product-list"></div>

<!-- Product Modal -->
<div class="modal fade" id="productModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="pname"></h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="pcategory"></p>
                <p>Price: $<span id="pprice"></span></p>
                <img id="pimage" width="100%">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    $.get("{{ route('frontend.products') }}", function(products){

        let html = '';
        products.forEach(p => {
            html += `
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="/uploads/products/${p.image}" class="card-img-top">
                    <div class="card-body">
                        <h6>${p.name}</h6>
                        <p>$${p.price}</p>
                        <button class="btn btn-sm btn-primary view" data-id="${p.id}">
                            View
                        </button>
                    </div>
                </div>
            </div>
            `;
        });

        $('#product-list').html(html);
    });

    // View product
    $(document).on('click','.view',function(){
        let id = $(this).data('id');

        $.get(`/product/${id}`, function(p){
            $('#pname').text(p.name);
            $('#pcategory').text('Category: ' + p.category.name);
            $('#pprice').text(p.price);
            $('#pimage').attr('src','/uploads/products/'+p.image);
            $('#productModal').modal('show');
        });
    });

});
</script>
@endsection
