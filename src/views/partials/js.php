<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="/js/main.js"></script>
<script>
    function updateCart(id, input){
        product_amount = input.value;
        if (product_amount > 0){
            window.location.href = '/cart/edit/'+id+'/'+product_amount;
        }
    }
</script>