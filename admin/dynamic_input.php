<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <input type="text" name="name" placeholder="Name" />
            <button class="add" id="add">Add</button> <br/>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function(){
            var addButton = $('.add');
            var container = $('.container');
            var field = '<div class="append_field"><input type="text" name="name" placeholder="Name" /> <button class="remove" id="remove">Remove</button> <br/> <div>';
            var m = 1;

            $(addButton).click(function(){
                $(container).append(field);
            });

            $(container).on("click", ".remove", function(e){
                e.preventDefault();
                $(this).parent('.append_field').remove();
            });
        });
    </script>
</html>