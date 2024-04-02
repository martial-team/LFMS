<?php if(Auth::user()->type != 'company'): ?>
    <?php $__env->startSection('page-title', __('Companies')); ?>
<?php else: ?>
    <?php $__env->startSection('page-title', __('Employee')); ?>
<?php endif; ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row align-items-center mb-3">
        <div class="col-md-12 d-flex align-items-center  justify-content-end">
            <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
                <a href="<?php echo e(route('users.list')); ?>" class="btn btn-sm btn-primary mx-1" data-ajax-popup="true" data-size="md"
                    data-title="Add User" data-toggle="tooltip" title="<?php echo e(__('List View')); ?>"
                    data-bs-original-title="<?php echo e(__('List View')); ?>" data-bs-placement="top" data-bs-toggle="tooltip">
                    <i class="ti ti-menu-2"></i>
                </a>
            </div>

            <?php if(\Auth::user()->type == 'company'): ?>
                <a href="<?php echo e(route('userlog.index')); ?>" class="btn btn-sm btn-primary btn-icon m-1"
                    data-bs-toggle="tooltip"title="<?php echo e(__('User Log')); ?>">
                    <i class="ti ti-user-check"></i>
                </a>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['create member', 'create user'])): ?>
                <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
                    <a href="#" class="btn btn-sm btn-primary mx-1" data-ajax-popup="true" data-size="lg"
                        data-title="<?php echo e(Auth::user()->type == 'super admin' ? __('Create New Company') : __('Create New Employee')); ?>"
                        data-url="<?php echo e(route('users.create')); ?>" data-toggle="tooltip"
                        title="<?php echo e(Auth::user()->type == 'super admin' ? __('Create New Company') : __('Create New Employee')); ?>">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php if(Auth::user()->type != 'company'): ?>
        <li class="breadcrumb-item"><?php echo e(__('Companies')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item"><?php echo e(__('Employee')); ?></li>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row g-0 pt-0">
        <div class="col-xxl-12">
            <div class="row g-0">

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-xxl-3 col-lg-4 col-sm-6 border-end border-bottom">
                        <div class="card  shadow-none bg-transparent border h-100 text-center rounded-0">
                            <div class="card-header border-0 pb-0">


                                <?php if(Gate::check('delete member') || Gate::check('delete user')): ?>
                                    <div class="card-header-right">
                                        <div class="btn-group card-option">

                                            <?php if(Auth::user()->type == 'super admin'): ?>
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end">

                                                    <?php if($user->email_verified_at == null || $user->email_verified_at == ''): ?>
                                                        <a href="#" class="dropdown-item bs-pass-para "
                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                            data-confirm-yes="verify-form-<?php echo e($user->id); ?>"
                                                            title="<?php echo e(__('Verify Email')); ?>" data-bs-toggle="tooltip"
                                                            data-bs-placement="top">
                                                            <i class="ti ti-checks"></i>
                                                            <?php echo e(__('Verify Email')); ?>


                                                        </a>
                                                        <?php echo Form::open([
                                                            'method' => 'POST',
                                                            'route' => ['users.verify', $user->id],
                                                            'id' => 'verify-form-' . $user->id,
                                                        ]); ?>

                                                        <?php echo Form::close(); ?>

                                                    <?php else: ?>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="<?php echo e(__('verified Email')); ?>"
                                                            data-size="md" data-title="<?php echo e(__('verified Email')); ?>">
                                                            <i class="ti ti-checks "></i>
                                                            <?php echo e(__('Verified Email')); ?>

                                                        </a>
                                                    <?php endif; ?>



                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['edit member', 'edit user'])): ?>


                                                        <a href="<?php echo e(route('login.with.admin', $user->id)); ?>"
                                                            class="dropdown-item" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="<?php echo e(__('Login as company ')); ?>">
                                                            <i class="ti ti-replace py-1"></i>
                                                            <span><?php echo e(__('Login as company')); ?></span>
                                                        </a>

                                                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="dropdown-item"
                                                            data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                            <i class="ti ti-pencil"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                        </a>
                                                    <?php endif; ?>

                                                    <a href="#!"
                                                        data-url="<?php echo e(route('company.reset', \Crypt::encrypt($user->id))); ?>"
                                                        data-ajax-popup="true" data-size="md" class="dropdown-item"
                                                        data-bs-original-title="<?php echo e(__('Reset Password')); ?>"
                                                        data-title="<?php echo e(__('Reset Password')); ?>"
                                                        title="<?php echo e(__('Reset Password')); ?>">
                                                        <i class="ti ti-adjustments"></i>
                                                        <span> <?php echo e(__('Reset Password')); ?></span>
                                                    </a>
                                                    
                                                    <?php if($user->id != 2): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['delete member', 'delete user'])): ?>
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['users.destroy', $user->id],
                                                                'id' => 'delete-form-' . $user->id,
                                                            ]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para-user-delete"
                                                                data-id="<?php echo e($user['id']); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="delete-form-<?php echo e($user->id); ?>"
                                                                title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                                data-bs-placement="top">
                                                                <i class="ti ti-archive"></i>
                                                                <span> <?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>


                                                    <?php if($user->is_enable_login == 1): ?>
                                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                            class="dropdown-item">
                                                            <i class="ti ti-road-sign"></i>
                                                            <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                                        </a>
                                                    <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                        <a href="#"
                                                            data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                                            data-ajax-popup="true" data-size="md"
                                                            class="dropdown-item login_enable"
                                                            data-title="<?php echo e(__('New Password')); ?>" class="dropdown-item">
                                                            <i class="ti ti-road-sign"></i>
                                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                            class="dropdown-item">
                                                            <i class="ti ti-road-sign"></i>
                                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                        </a>
                                                    <?php endif; ?>

                                                </div>
                                            <?php else: ?>
                                                <?php if($user->is_active == 1 && $user->is_disable == 1): ?>
                                                    <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a data-url="<?php echo e(route('users.show', $user->id)); ?>" href="#"
                                                            class="dropdown-item" data-ajax-popup="true" data-size="md"
                                                            data-title="<?php echo e($user->name . __("'s Group")); ?>">
                                                            <i class="ti ti-eye"></i>
                                                            <span><?php echo e(__('View Groups')); ?></span>
                                                        </a>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['edit member', 'edit user'])): ?>
                                                            <a href="<?php echo e(route('users.edit', $user->id)); ?>"
                                                                class="dropdown-item"
                                                                data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                                <i class="ti ti-pencil"></i>
                                                                <span><?php echo e(__('Edit')); ?></span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="#!"
                                                            data-url="<?php echo e(route('company.reset', \Crypt::encrypt($user->id))); ?>"
                                                            data-ajax-popup="true" data-size="md" class="dropdown-item"
                                                            data-bs-original-title="<?php echo e(__('Reset Password')); ?>"
                                                            data-title="<?php echo e(__('Reset Password')); ?>"
                                                            title="<?php echo e(__('Reset Password')); ?>">
                                                            <i class="ti ti-adjustments"></i>
                                                            <span> <?php echo e(__('Reset Password')); ?></span>
                                                        </a>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['delete member', 'delete user'])): ?>
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['users.destroy', $user->id],
                                                                'id' => 'delete-form-' . $user->id,
                                                            ]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para"
                                                                data-id="<?php echo e($user['id']); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="delete-form-<?php echo e($user->id); ?>"
                                                                title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                                data-bs-placement="top">
                                                                <i class="ti ti-archive"></i>
                                                                <span> <?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>


                                                        <?php if($user->is_enable_login == 1): ?>
                                                            <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                                class="dropdown-item">
                                                                <i class="ti ti-road-sign"></i>
                                                                <span class="text-danger">
                                                                    <?php echo e(__('Login Disable')); ?></span>
                                                            </a>
                                                        <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                            <a href="#"
                                                                data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                                                data-ajax-popup="true" data-size="md"
                                                                class="dropdown-item login_enable"
                                                                data-title="<?php echo e(__('New Password')); ?>"
                                                                class="dropdown-item">
                                                                <i class="ti ti-road-sign"></i>
                                                                <span class="text-success">
                                                                    <?php echo e(__('Login Enable')); ?></span>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                                class="dropdown-item">
                                                                <i class="ti ti-road-sign"></i>
                                                                <span class="text-success">
                                                                    <?php echo e(__('Login Enable')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <a href="#" class="action-item"><i class="ti ti-lock"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                <?php endif; ?>


                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="<?php echo e(!empty($user->avatar)
                                        ? asset('storage/uploads/profile/' . $user->avatar)
                                        : asset('storage/uploads/profile/avatar.png')); ?>"
                                        class="img-user wid-80 round-img
                                rounded-circle">
                                </div>
                                <h4 class=" mt-3 text-primary"><?php echo e($user->name); ?></h4>

                                <small class="text-primary"><?php echo e($user->email); ?></small>
                                <p></p>
                                <div class="text-center" data-bs-toggle="tooltip" title="<?php echo e(__('Last Login')); ?>">
                                    <?php echo e(!empty($user->last_login_at) ? $user->last_login_at : ''); ?>

                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <?php if(\Auth::user()->type == 'super admin'): ?>
                                            <div class="">
                                                <a href="#" class="btn btn-sm btn-light-primary text-sm"
                                                    data-url="<?php echo e(route('plan.upgrade', $user->id)); ?>" data-size="lg"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>">
                                                    <?php echo e(__('Upgrade Plan')); ?>

                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="badge p-2 px-3 rounded bg-primary"><?php echo e(ucfirst($user->type)); ?>

                                            </div>
                                        <?php endif; ?>
                                    </h6>

                                    <h6 class="mb-0">
                                        <?php if(\Auth::user()->type == 'super admin'): ?>
                                            <div class=" ">
                                                <a href="#" data-url="<?php echo e(route('company.info', $user->id)); ?>"
                                                    data-size="lg" data-ajax-popup="true"
                                                    class="btn btn-sm btn-light-primary text-sm"
                                                    data-title="<?php echo e(__('Company Info')); ?>"><?php echo e(__('AdminHub')); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </h6>

                                </div>

                            </div>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-6 col-xxl-3 col-lg-4 col-sm-6 border-end border-bottom">
                    <div class="card  shadow-none bg-transparent border h-100 text-center rounded-0">
                        <div class="card-body border-0 pb-0">
                            <a href="#" class="btn-addnew-project border-0" data-ajax-popup="true" data-size="lg"
                                data-title="Create New User" data-url="<?php echo e(route('users.create')); ?>">
                                <div class="bg-primary proj-add-icon">
                                    <i class="ti ti-plus"></i>
                                </div>
                                <h6 class="mt-4 mb-2"><?php echo e(__('New User')); ?></h6>
                                <p class="text-muted text-center"><?php echo e(__('Click here to add New User')); ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-script'); ?>
    <script>
        $(document).on('change', '#password_switch', function() {
            if ($(this).is(':checked')) {
                $('.ps_div').removeClass('d-none');
                $('#password').attr("required", true);

            } else {
                $('.ps_div').addClass('d-none');
                $('#password').val(null);
                $('#password').removeAttr("required");
            }
        });
        $(document).on('click', '.login_enable', function() {
            setTimeout(function() {
                $('.modal-body').append($('<input>', {
                    type: 'hidden',
                    val: 'true',
                    name: 'login_enable'
                }));
            }, 2000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Downloads/advocategosaas-21nulled/codecanyon-46105956-advocatego-saas-legal-practice-management/main-file/resources/views/users/index.blade.php ENDPATH**/ ?>