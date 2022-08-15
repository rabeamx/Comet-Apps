(function($){

    $(document).ready(function(){
        // delete btn alert
        $('.delete-form').submit(function(){
            // e.preventDefault();
            let conf = confirm('Are you sure?');

            if(conf){
                return true;
            } else{
                return false;
            }

        });
    });

})(jQuery)