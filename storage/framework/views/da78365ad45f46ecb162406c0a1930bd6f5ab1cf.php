<?php $__env->startSection('content'); ?>

        <h1>Car <?php echo e($car->id); ?></h1>
        <ul>
            <li>Make: <?php echo e($car->make); ?></li>
            <li>Model: <?php echo e($car->model); ?></li>
            <li>Produced on: <?php echo e($car->produced_on); ?></li>
        </ul>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('cars.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>