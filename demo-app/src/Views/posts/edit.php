<a href="/posts" class="btn btn-primary">Back to posts</a>

<hr>

<form id="update-post-form" action="/posts/<?= $post->id ?>" method="PUT">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $post->title ?>"
               placeholder="Once there was a Rabbit">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" placeholder="The rabbit name was Greg..." cols="30"
                  rows="4"><?= $post->content ?></textarea>
    </div>
    <div class="alert alert-danger" style="display: none;" role="alert" id="update-post-form-errors">
    </div>
    <button type="submit" id="update-post-button" class="btn btn-primary">Save</button>
</form>


<script type="application/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        const $form = $('form#update-post-form');
        const $errors = $('#update-post-form-errors');
        const $button = $('#update-post-button');

        function errors(errors) {
            $errors.html(
                errors.map(error => `- ${error}`).join('<br>')
            );

            $errors.show();
        }

        $form.on('submit', function (event) {
            event.preventDefault();
            $button.html('Loading...');

            $.ajax({
                url: '/posts',
                method: 'PUT',
                data: $form.serialize(),
            })
                .then(function () {
                    $errors.hide();
                    $button.html('Save');
                    window.location = '/posts';
                }, function (response) {
                    if (response.status === 400) {
                        const parsedResponse = JSON.parse(response.responseText);
                        if (parsedResponse.hasOwnProperty('errors')) {
                            errors(parsedResponse.errors);
                        }
                    }

                    $button.html('Save');
                });
        });
    });
</script>
