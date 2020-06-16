<div class="container">
  <div class="row">
    <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><?= $user['firstname'] . ' ' . $user['lastname']; ?></h3>
        <hr>
        <?php if (session()->get('Success')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('Success'); ?>
          </div>
        <?php endif; ?>
        <form action="/profile" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']); ?>">
              </div>
            </div>

            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname', $user['lastname']); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" readonly>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm">
              </div>
            </div>
          </div>
          <?php if (isset($validation)) : ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors(); ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>