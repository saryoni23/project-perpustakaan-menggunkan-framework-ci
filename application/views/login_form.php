<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/reset.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login.css');?>" />
        <title>Login</title>
    </head>

<body>
<div id="login_box">

	<h1>Login</h1>

	<?= form_open('login', ['name' => 'login_form', 'id' => 'login_form']); ?>

    <?php if (!empty($this->session->flashdata('error'))) : ?>
        <p id="message"><?= $this->session->flashdata('error') ?></p>
    <?php endif ?>

	<p>
		<?= form_label('Username', 'username') ?>
        <?= form_input('username', $input->username, ['class' => 'form_field']) ?>
	</p>
	<?= form_error('username', '<p class="field_error">', '</p>');?>

	<p>
		<?= form_label('Password', 'password') ?>
		<?= form_password('password', $input->password, ['class' => 'form_field']) ?>
	</p>
	<?= form_error('password', '<p class="field_error">', '</p>');?>

	<p>
		<input type="submit" name="submit" id="submit" value="O K"/>
	</p>
	<?= form_close() ?>
</div>
</body>
</html>