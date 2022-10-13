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

        // icon select
        $('button.show-icon').click(function(e){
            e.preventDefault();

            // alert();
            $('#select-icon').modal('show');

        });

        // select icon
        $('.select-icon-haq .preview-icon code').click(function(){
            // alert();
            let icon_name = $(this).html();
            console.log(icon_name);

            $('.select-haq-icon-input').val(icon_name);
            $('#select-icon').modal('hide');
        });

        // portfolio gallery
        $('#portfolio-gallery').change(function(e){

             // alert();
            // console.log(e.target.files);
            // const gallery = URL.createObjectURL(e.target.files);
            // console.log(gallery);
            // $('#slider-photo-preview').attr('src', photo_url);
            // console.log(e.target.files);
            const files = e.target.files;
            // const gallery_ui = '';
            // files.forEach( items => {
            //     console.log(items);
            //     gallery_ui
            // });
            // console.log(files.length);

            // let ob_url;

            let gallery_ui = '';
            for( let i = 0; i < files.length; i++ ){
                // ob_url += URL.createObjectURL(files[i]);

                const ob_url = URL.createObjectURL(files[i]);
                gallery_ui += `<img src="${ ob_url }">`;
                // console.log(ob_url);

                // let ob_url = URL.createObjectURL(files[i]);
                // console.log(ob_url);

                // console.log(files[i]);
            }
            // console.log(ob_url);

            // console.log(gallery_ui);
            $('.port-gall').html(gallery_ui);
        });

        // ck editor
        CKEDITOR.replace('portfolio-desc'); 

        // select 2
        $('.comet-select-2').select2();

        // post type selector
        $('#post-type-selector').change(function(){

            const type = $(this).val();
            // console.log(type);

            if( type == 'standard' ){

                $('.post-standard').show();
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').hide();

            } else if( type == 'gallery' ){

                $('.post-standard').hide();
                $('.post-gallery').show();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').hide();

            } else if( type == 'video' ){

                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').show();
                $('.post-audio').hide();
                $('.post-quote').hide();

            } else if( type == 'audio' ){

                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').show();
                $('.post-quote').hide();

            } else if( type == 'quote' ){

                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').show();

            }

        });



    }); 

})(jQuery)