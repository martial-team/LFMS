<?php echo e(Form::open(['route' => 'users.store', 'method' => 'post'])); ?>

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo Form::label('name', __('Name'), ['class' => 'form-label']); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control','placeholder'=>__('Enter User Name')]); ?>


            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('Email', __('Email'), ['class' => 'form-label'])); ?>

                <?php echo Form::text('email', null, ['class' => 'form-control','placeholder'=>__('Enter User Email')]); ?>


            </div>

            <?php if(Auth::user()->type == 'company'): ?>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('role', __('Role'), ['class' => 'form-label'])); ?>

                    <?php echo Form::select('role', $roles, null, ['class' => 'form-control multi-select']); ?>

                </div>
            <?php endif; ?>

            <div class="col-md-6 mb-3 form-group mt-4">
                <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer"
                        value="on" id="password_switch">
                    <label class="form-check-label" for="password_switch"></label>
                </div>
            </div>

            <div class="form-group col-md-6 ps_div d-none">
                <?php echo Form::label('password', __('Password'), ['class' => 'form-label']); ?>

                <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"8"))); ?>

            </div>

        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary ms-2">
    </div>
<?php echo e(Form::close()); ?>



<?php /**PATH /home/user/Downloads/advocategosaas-21nulled/codecanyon-46105956-advocatego-saas-legal-practice-management/main-file/resources/views/users/create.blade.php ENDPATH**/ ?>