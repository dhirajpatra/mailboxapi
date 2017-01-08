<?php $__env->startSection('content'); ?>

    <div>
        
        <p><?php echo e(Session::get('alert-success')); ?></p>
        <?php echo Form::open(array('url' => 'cars/create')); ?>

        <h1>Enter Car Details</h1>
        <ul>
            <li>Make: <input type="text" name="make"></li>
            <li>Model: <input type="text" name="model"></li>
            <li>Produced on: <input type="text" name="produced_on"></li>
            <input type="submit" value="Save">
        </ul>
        <?php echo Form::close(); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('cars.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>