<?php $__env->startSection('title', 'Daftar Kamar Kos'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <h2 style="color: #000; margin-bottom: 0.5rem; display: inline-block; background: #FFE951; padding: 0.5rem 1rem; border: 4px solid #000; box-shadow: 6px 6px 0 #000;">
        📋 DAFTAR KAMAR
    </h2>
    <p style="color: #333; margin-top: 1rem; font-weight: 600; font-size: 1.1rem;">Temukan kamar kos yang sesuai dengan kebutuhan Anda</p>
</div>

<?php if($rooms->isEmpty()): ?>
    <div class="card" style="text-align: center; padding: 3rem;">
        <p style="font-size: 1.3rem; color: #000; font-weight: 700;">BELUM ADA KAMAR TERSEDIA</p>
    </div>
<?php else: ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card room-card" style="position: relative; overflow: visible;">
                <!-- Status Badge -->
                <div style="position: absolute; top: -15px; right: -15px; z-index: 10;">
                    <span style="
                        padding: 0.6rem 1.2rem; 
                        border: 4px solid #000; 
                        font-size: 0.85rem; 
                        font-weight: 700;
                        text-transform: uppercase;
                        box-shadow: 4px 4px 0px #000;
                        <?php echo e($room->status === 'Tersedia' ? 'background-color: #A8FF76;' : 'background-color: #FF6B9D;'); ?>

                        display: inline-block;
                        transform: rotate(5deg);
                    ">
                        <?php echo e($room->status === 'Tersedia' ? '✓ AVAILABLE' : '✗ BOOKED'); ?>

                    </span>
                </div>

                <!-- Room Number -->
                <div style="background: #000; color: #FFE951; padding: 1rem; margin: -1.5rem -1.5rem 1.5rem -1.5rem; border-bottom: 4px solid #FFE951;">
                    <h3 style="font-size: 2rem; margin: 0; letter-spacing: 2px;">ROOM <?php echo e($room->room_number); ?></h3>
                </div>

                <!-- Room Info -->
                <div style="margin-bottom: 1.5rem;">
                    <div style="background: #F0F0F0; padding: 1rem; border: 3px solid #000; margin-bottom: 1rem;">
                        <p style="margin-bottom: 0.5rem; font-weight: 700; font-size: 0.9rem; text-transform: uppercase;">
                            <span style="background: #76D9FF; padding: 0.2rem 0.5rem; border: 2px solid #000;">Tipe</span>
                        </p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #000;"><?php echo e($room->type); ?></p>
                    </div>

                    <div style="background: #FFF; padding: 1rem; border: 3px solid #000; margin-bottom: 1rem;">
                        <p style="margin-bottom: 0.5rem; font-weight: 700; font-size: 0.9rem; text-transform: uppercase;">
                            <span style="background: #FFE951; padding: 0.2rem 0.5rem; border: 2px solid #000;">Fasilitas</span>
                        </p>
                        <p style="font-weight: 600; color: #333; line-height: 1.6;"><?php echo e($room->facilities ?? 'Tidak ada info'); ?></p>
                    </div>

                    <?php if($room->description): ?>
                        <p style="padding: 0.8rem; background: #F9F9F9; border-left: 4px solid #000; font-size: 0.95rem; font-weight: 500; color: #666;">
                            <?php echo e($room->description); ?>

                        </p>
                    <?php endif; ?>
                </div>

                <!-- Price -->
                <div style="background: #000; color: #FFE951; padding: 1.2rem; margin: 1.5rem -1.5rem -1.5rem -1.5rem; text-align: center; border-top: 4px solid #FFE951;">
                    <p style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.3rem; letter-spacing: 1px;">Harga</p>
                    <p style="font-size: 2rem; font-weight: 700; letter-spacing: -1px;">
                        Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?>

                    </p>
                    <p style="font-size: 0.9rem; font-weight: 600; margin-top: 0.2rem;">/bulan</p>
                </div>

                <!-- Button -->
                <div style="margin-top: 1.5rem;">
                    <?php if($room->isAvailable()): ?>
                        <a href="<?php echo e(route('bookings.create', $room)); ?>" class="btn btn-success" 
                           style="width: 100%; text-align: center; display: block; font-size: 1.1rem;">
                            🎯 PESAN SEKARANG
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled style="width: 100%; font-size: 1.1rem; cursor: not-allowed;">
                            ✗ TIDAK TERSEDIA
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
<style>
    .room-card {
        position: relative;
    }

    .room-card::before {
        content: '';
        position: absolute;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(0,0,0,0.03) 10px,
            rgba(0,0,0,0.03) 20px
        );
        z-index: -1;
        border: 4px solid #000;
    }

    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KOS\resources\views/rooms/index.blade.php ENDPATH**/ ?>