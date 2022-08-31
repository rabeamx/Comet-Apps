(function($){

    $(document).ready(function(){
        // delete btn alert
        $('.delete-form').submit(function(){
            // e.preventDefault();
            let conf = confirm('Are you sure?');

            if(conf){
                return true;
            } else{
                // e.preventDefault();
                return false;
            } 

        });

        // our data tables
        $('.data-table-haq').DataTable();

        // slider photo management
        $('#slider-photo').change(function(e){

            // alert();
            // console.log(e.target.files);
            const photo_url = URL.createObjectURL(e.target.files[0]);
            // console.log(photo_url);
            $('#slider-photo-preview').attr('src', photo_url);
            
        });

        // add-new-slider-button == a tag a jhamela thake ==
        let btn_no = 1;
        $('#add-new-slider-button').click(function(e){

            e.preventDefault();
            // alert();
            
            // if(btn_no <= 2){
            //     $('.slider-btn-opt').prepend(`
            
            //     <div class="btn-opt-area">
            //         <span>Button #${btn_no}</span>
            //         <input class="form-control" name="btn_title[]" type="text" placeholder="Button Title">
            //         <input class="form-control" name="btn_link[]" type="text" placeholder="Button Link">
            //     </div>

            //     `);
            //     btn_no++;
            // } else{
            //     alert(`you can't add more button!`);
            // }

            $('.slider-btn-opt').prepend(`
            
            <div class="btn-opt-area">
                <span>Button #${btn_no}</span>
                <span class="badge badge-danger remove-btn" style="margin-left:150px;cursor:pointer;" >remove</span>
                <input class="form-control" name="btn_title[]" type="text" placeholder="Button Title">
                <input class="form-control" name="btn_link[]" type="text" placeholder="Button Link">
                <select class="form-control" name="btn_type[]" >
                    <option value="btn-light-out" > default </option>
                    <option value="btn-color btn-full" > Red </option>
                </select>
                <hr/>
            </div>

            `);
            btn_no++;

        });

        // remove button
        $(document).on('click', '.remove-btn', function(){
            // alert();
            $(this).closest('.btn-opt-area').remove();
        }); 

    }); 

})(jQuery)