<?php $__env->startSection('title', 'Daftar Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <h2 style="margin-bottom: 0.5rem; display: inline-block; background: #A8FF76; padding: 0.8rem 1.5rem; border: 4px solid #000; box-shadow: 8px 8px 0 #000;">
        📋 DAFTAR PEMESANAN
    </h2>
    <p style="color: #333; margin-top: 1rem; font-weight: 600; font-size: 1.1rem;">Semua pemesanan kamar kos</p>
</div>

<?php if($bookings->isEmpty()): ?>
    <div class="card" style="text-align: center; padding: 4rem; background: #FFF3CD;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">📭</div>
        <p style="font-size: 1.5rem; color: #000; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem;">BELUM ADA PEMESANAN</p>
        <a href="<?php echo e(route('rooms.index')); ?>" class="btn btn-primary" style="margin-top: 1rem; font-size: 1.1rem;">
            🏠 LIHAT KAMAR TERSEDIA
        </a>
    </div>
<?php else: ?>
    <div class="card" style="overflow-x: auto; padding: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #000; color: #FFE951; border-bottom: 4px solid #FFE951;">
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">No.</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Kamar</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Pemesan</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Kontak</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Durasi</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Tanggal</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Status</th>
                    <th style="padding: 1.2rem; text-align: left; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom: 3px solid #000; background: <?php echo e($index % 2 === 0 ? '#FAFAFA' : '#FFF'); ?>;">
                        <td style="padding: 1.2rem; font-weight: 700; font-size: 1.1rem;">
                            <div style="background: #000; color: #FFE951; padding: 0.3rem 0.7rem; display: inline-block; border: 2px solid #FFE951;">
                                <?php echo e($index + 1); ?>

                            </div>
                        </td>
                        <td style="padding: 1.2rem;">
                            <span style="font-weight: 700; font-size: 1.3rem; color: #000; background: #FFE951; padding: 0.3rem 0.8rem; border: 3px solid #000;">
                                <?php echo e($booking->room->room_number); ?>

                            </span>
                        </td>
                        <td style="padding: 1.2rem; font-weight: 600; font-size: 1rem;"><?php echo e($booking->name); ?></td>
                        <td style="padding: 1.2rem; font-weight: 600; font-size: 0.95rem;"><?php echo e($booking->contact); ?></td>
                        <td style="padding: 1.2rem; font-weight: 700; font-size: 1rem;"><?php echo e($booking->duration_months); ?> Bulan</td>
                        <td style="padding: 1.2rem; font-weight: 600; font-size: 0.95rem;"><?php echo e($booking->move_in_date->format('d/m/Y')); ?></td>
                        <td style="padding: 1.2rem;">
                            <span style="
                                padding: 0.5rem 1rem; 
                                border: 3px solid #000; 
                                font-size: 0.85rem; 
                                font-weight: 700;
                                text-transform: uppercase;
                                box-shadow: 3px 3px 0px #000;
                                display: inline-block;
                                <?php if($booking->status === 'Confirmed'): ?>
                                    background-color: #A8FF76;
                                <?php elseif($booking->status === 'Cancelled'): ?>
                                    background-color: #FF6B9D;
                                <?php else: ?>
                                    background-color: #FFF3CD;
                                <?php endif; ?>
                            ">
                                <?php echo e($booking->status); ?>

                            </span>
                        </td>
                        <td style="padding: 1.2rem; font-weight: 700; font-size: 1.2rem; color: #000;">
                            <div style="background: #A8FF76; padding: 0.5rem 0.8rem; border: 3px solid #000; display: inline-block;">
                                Rp <?php echo e(number_format($booking->room->price * $booking->duration_months, 0, ',', '.')); ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <div style="display: inline-block; background: #000; color: #FFE951; padding: 1rem 2rem; border: 4px solid #FFE951; box-shadow: 6px 6px 0 #FFE951; font-weight: 700; font-size: 1.1rem;">
            TOTAL PEMESANAN: <?php echo e($bookings->count()); ?>

        </div>
    </div>
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
<style>
    @media (max-width: 1200px) {
        table {
            font-size: 0.85rem;
        }
        th, td {
            padding: 0.8rem !important;
        }
    }

    @media (max-width: 768px) {
        table {
            font-size: 0.75rem;
        }
        th, td {
            padding: 0.5rem !important;
        }
        
        span[style*="font-size: 1.3rem"] {
            font-size: 1rem !important;
        }
    }

    tbody tr {
        transition: all 0.2s ease;
    }

    tbody tr:hover {
        transform: translateX(5px);
        background: #FFE951 !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KOS\resources\views/bookings/index.blade.php ENDPATH**/ ?>