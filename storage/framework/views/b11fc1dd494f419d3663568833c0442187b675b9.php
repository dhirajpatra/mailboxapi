<?php $__env->startSection('content'); ?>

    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>:
    <h1>Car <?php echo e($car->id); ?></h1>
    <ul>
        <li>Make: <?php echo e($car->make); ?></li>
        <li>Model: <?php echo e($car->model); ?></li>
        <li>Produced on: <?php echo e($car->produced_on); ?></li>
    </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cars.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>