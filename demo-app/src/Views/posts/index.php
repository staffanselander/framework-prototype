

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th>Title</th>
        <th>Content</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts ?? [] as $post): ?>
        <tr>
            <th scope="row"><?= $post->id ?></th>
            <td><?= $post->title ?></td>
            <td><?= $post->content ?></td>
            <td><a href="/posts/<?= $post->id ?>/edit" class="btn btn-primary btn-sm pull-right">EDIT</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href = '/posts/create'">Create new post</button>
