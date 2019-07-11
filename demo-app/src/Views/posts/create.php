<a href="/posts" class="btn btn-primary">Back to posts</a>

<hr>

<form id="create-post-form" action="/posts" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Once there was a Rabbit">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" placeholder="The rabbit name was Greg..." cols="30"
                  rows="4"></textarea>
    </div>
    <div class="alert alert-danger" style="display: none;" role="alert" id="create-post-form-errors">
    </div>
    <button type="submit" id="create-post-button" class="btn btn-primary">Submit</button>
</form>


<script type="application/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const $form = $('form#create-post-form');
        const $errors = $('#create-post-form-errors');
        const $button = $('#create-post-button');

        function errors(errors) {
            $errors.html(
                errors.map(error => `- ${error}`).join('<br>')
            );

            $errors.show();
        }

        $form.on('submit', function (event) {
            event.preventDefault();
            $button.html('Loading...');

            $.post('/posts', $form.serialize())
                .then(function() {
                    $errors.hide();
                    $button.html('Submit');
                    window.location = '/posts';
                }, function(response) {
                    if (response.status === 400) {
                        const parsedResponse = JSON.parse(response.responseText);
                        if (parsedResponse.hasOwnProperty('errors')) {
                            errors(parsedResponse.errors);
                        }
                    }

                    $button.html('Submit');
                });
        });
    });
</script>
