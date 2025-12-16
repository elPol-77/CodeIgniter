<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Pablo Benlloch Torres"
    />
    <meta name="generator" content="Astro v5.13.2" />
    <title>News View </title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/dashboard/"
    />
    <script src="<?= base_url('assets/js/color-modes.js')?>"></script>
    <link href="<?= base_url('assets/dist/css/bootstrap.min.css')?> " rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="<?= base_url('assets/css/dashboard.css')?>" rel="stylesheet" />


  </head>
<section class="container mt-4">
    <div class="mb-3">
        <a href="<?= base_url('/news')?>" class="btn btn-outline-secondary">
            &larr; Volver a listado de noticias
        </a>
    </div>

    <h2><?= esc($title) ?></h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif ?>
    
    <?php if (validation_list_errors()): ?>
        <div class="alert alert-warning">
            <?= validation_list_errors() ?>
        </div>
    <?php endif ?>

    <?php if (!empty($news) && is_array($news)) : ?>
    
    <form method="post" action="<?= base_url('news/update/updated/' .$news['id']) ?>" class="row g-3">
        <?= csrf_field() ?>

        <div class="col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= esc($news['title']) ?>">
        </div>

        <div class="col-md-6">
            <label for="category" class="form-label">Category</label>
            <select name="id_category" id="category" class="form-select">
                <?php if (! empty($category) && is_array($category)): ?>
                    <?php foreach ($category as $category_item) :?>
                    <option value="<?= $category_item["id"] ?>">
                        <?= $category_item["category"] ?>
                    </option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </div>

        <div class="col-12">
            <label for="body" class="form-label">Text</label>
            <textarea name="body" id="body" class="form-control" rows="4"><?= esc($news['body']) ?></textarea>
        </div>

        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary" class="btn btn-outline-warning">Update item</button>
        </div>
    </form>
    <?php endif; ?>
</section>