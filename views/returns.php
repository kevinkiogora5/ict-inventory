<main>
    <div class="container-fluid">

        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">Manage Returns</h4>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Form Validation start -->
        <div class="row ">
            <!-- Tooltips start -->
            <div class="col-12">
                <div class="card">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add Blogs
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3 app-form rounded-control" id="postblog"
                                            enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <label class="form-label">Title</label>
                                                <input class="form-control" id='title' name="title" type="text">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Content</label>
                                                <input class="form-control" id='content' name="content" type="text">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Image</label>
                                                <input class="form-control" id="image" name="featured_image" type="file"
                                                    accept="image/*">

                                            </div>
                                            <button type="submit" id="tuma" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Posted On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($BLOGS as $product): ?>
                                    <tr data-id="<?= htmlspecialchars($product['id']) ?>">
                                        <td><?= htmlspecialchars($product['id']) ?></td>
                                        <td><?= htmlspecialchars($product['title']) ?></td>
                                        <td><?= htmlspecialchars($product['content']) ?></td>
                                        <td>
                                            <img src="/servefile?file=<?= urlencode($product['featured_image']) ?>&dir=product"
                                                alt="<?= htmlspecialchars($product['title']) ?>" width="50" height="50">
                                        </td>
                                        <td><?= htmlspecialchars($product['created_at']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openModal(<?= $product['id'] ?>);">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tooltips end -->
    </div>
    <!-- Form Validation end -->

    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="/scripts/base/base.js"></script>
<script>
    var milk = <?php echo json_encode($BLOGS) ?>;
</script>
<script src="/scripts/blog/blog.js"></script>