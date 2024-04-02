<?php $__env->startSection('page-title', __('Role')); ?>

<?php $__env->startSection('action-button'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create role')): ?>
<div class="text-sm-end d-flex all-button-box justify-content-sm-end">
    <a href="#" class="btn btn-sm btn-primary mx-1" data-ajax-popup="true" data-size="lg" data-title="Add Role"
        data-url="<?php echo e(route('roles.create')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create New Role')); ?>">
        <i class="ti ti-plus"></i>
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><?php echo e(__('Role')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row p-0">
    <div class="col-md-12">
        <div class="card-body table-border-style ">
            <div class="table-responsive">
                <table class="table dataTable">
                    <thead>
                        <th><?php echo e(__('Role')); ?> </th>
                        <th><?php echo e(__('Permissions')); ?> </th>
                        <th width="100px"><?php echo e(__('Action')); ?> </th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="Role"><?php echo e(ucfirst($role->name)); ?></td>
                                <td class="" style="white-space: inherit">
                                    
                                    <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge rounded p-2 m-1 px-3 bg-primary">
                                            <a href="#" class="text-white"><?php echo e($permission->name); ?></a>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                        <div class="action-btn bg-light-secondary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center "
                                                data-url="<?php echo e(route('roles.edit',$role->id)); ?>" data-size="lg"
                                                data-ajax-popup="true" data-title="<?php echo e(__('Update Role')); ?>"
                                                title="<?php echo e(__('Edit')); ?>" data-bs-toggle="tooltip" data-bs-placement="top"><i class="ti ti-edit"></i></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($role->name != 'advocate' && $role->name != 'client' ): ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                            <div class="action-btn bg-light-secondary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($role->id); ?>" title="<?php echo e(__('Delete')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                            $role->id],'id'=>'delete-form-'.$role->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Downloads/advocategosaas-21nulled/codecanyon-46105956-advocatego-saas-legal-practice-management/main-file/resources/views/role/index.blade.php ENDPATH**/ ?>