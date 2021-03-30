<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;

use Botble\Miss\Http\Requests\ThisinhRequest;
use Botble\Miss\Models\Thisinh;
use Botble\Miss\Repositories\Interfaces\NamhocInterface;
use Botble\Miss\Repositories\Interfaces\TruongInterface;

class ThisinhForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $truong=app(TruongInterface::class)->pluck('ten_truong','id');
        $nam_hoc=app(NamhocInterface::class)->pluck('ten_nam_hoc','id');
        $this
            ->setupModel(new Thisinh)
            ->setValidatorClass(ThisinhRequest::class)
            ->withCustomFields()
            ->add('so_bao_danh', 'text', [
                'label'      => 'Số báo danh',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 001',
                    'data-counter' => 120,
                ],
            ])

            ->add('full_name', 'hidden', [
                'label'      => 'Tên thí sinh',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => '',
                    'data-counter' => 120,
                ],
            ])
            ->add('ho', 'text', [
                'label'      => 'Họ đệm thí sinh',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: Phạm Thị',
                    'data-counter' => 120,
                ],
            ])
            ->add('ten', 'text', [
                'label'      => 'Tên thí sinh',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: Minh Phương',
                    'data-counter' => 120,
                ],
            ])
            ->add('ngay_sinh', 'text', [
                'label'      => 'Ngày sinh',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class'  => 'form-control datepicker',
                    'data-date-format'=>config('core.base.general.date_format.js.date'),
                    'data-counter' => 30,
                ],
            ])
            ->add('dia_chi', 'text', [
                'label'      => 'Địa chỉ liên lạc',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 1 Nguyễn Đình Chiểu, P.4, Q.3, TP.HCM',
                    'data-counter' => 120,
                ],
            ])
            ->add('sdt', 'number', [
                'label'      => 'Số điện thoại',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 0981662418',
                    'data-counter' => 120,
                ],
            ])
            ->add('email', 'email', [
                'label'      => 'Email',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: huongpham@gmail.com',
                    'data-counter' => 120,
                ],
            ])
            ->add('sdt_nguoi_than', 'number', [
                'label'      => 'Số điện thoại người thân khẩn cấp',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 0981662418',
                    'data-counter' => 120,
                ],
            ])
            ->add('id_truong', 'customSelect', [
                'label'      => 'Tên trường',
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $truong,

            ])
            ->add('id_nam_hoc', 'customSelect', [
                'label'      => 'Tên năm học',
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $nam_hoc,

            ])
            ->add('mssv', 'text', [
                'label'      => 'Mã số sinh viên',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: DH20123123',
                    'data-counter' => 120,
                ],
            ])

            ->add('khoa_nganh', 'text', [
                'label'      => 'Khoa ngành',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: Quản trị kinh doanh',
                    'data-counter' => 120,
                ],
            ])
            ->add('chieu_cao', 'text', [
                'label'      => 'Chiều cao',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 1m73',
                    'data-counter' => 120,
                ],
            ])
            ->add('can_nang', 'text', [
                'label'      => 'Cân nặng',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 45kg',
                    'data-counter' => 120,
                ],
            ])
            ->add('so_do_ba_vong', 'text', [
                'label'      => 'Số đo ba vòng',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 80-90-80',
                    'data-counter' => 120,
                ],
            ])

            ->add('mo_ta_ly_lich', 'editor', [
                'label'      => __('Mô tả lý lịch'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'with-short-code' => false, // if true, it will add a button to select shortcode
                    'without-buttons' => false, // if true, all buttons will be hidden
                ],
            ])
            ->add('tuoi', 'number', [
                'label'      => 'Tuổi',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: 20',
                    'data-counter' => 120,
                ],
            ])

            ->add('luot_xem_profile', 'number', [
                'label'      => 'Lượt xem profile',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => '',
                    'data-counter' => 120,
                ],
                'default_value' => 0,
            ])
            ->add('luot_bau_chon', 'number', [
                'label'      => 'Lượt bầu chọn',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => '',
                    'data-counter' => 120,
                ],
                'default_value' => 0,
            ])
            ->add('luot_chia_se_fb', 'number', [
                'label'      => 'Lượt chia sẻ Facebook',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => '',
                    'data-counter' => 120,
                ],
                'default_value' => 0,
            ])
            ->add('luot_chia_se_khac', 'number', [
                'label'      => 'Lượt chia sẻ khác',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => '',
                    'data-counter' => 120,
                ],
                'default_value' => 0,
            ])
            ->add('vong_loai', 'customSelect', [
                'label'      => 'Vòng loại',
                'label_attr' => ['class' => 'control-label'],
                'choices'    => ['Ẩn','Hiện'],
                'default_value' => 0,
            ])
            ->add('vong_top_200', 'customSelect', [
                'label'      => 'Vòng top 200',
                'label_attr' => ['class' => 'control-label'],
                'choices'    => ['Ẩn','Hiện'],
                'default_value' => 0,
            ])
            ->add('vong_top_40', 'customSelect', [
                'label'      => 'Vòng top 40',
                'label_attr' => ['class' => 'control-label'],
                'choices'    => ['Ẩn','Hiện'],
                'default_value' => 0,
            ])
            ->add('vong_top_35', 'customSelect', [
                'label'      => 'Vòng top 35',
                'label_attr' => ['class' => 'control-label'],
                'choices'    => ['Ẩn','Hiện'],
                'default_value' => 0,
            ])
            ->add('video', 'text', [
                'label'      => 'Video',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => 'video',
                    'data-counter' => 120,
                ],
            ])
            ->add('ban_scan', 'mediaImage', [
                'label'      => 'Giấy chứng nhận',
                'label_attr' => ['class' => 'control-label '],
                'wrapper'    => [
                    'class' => 'form-group col-md-2',
                ],
            ])
            ->add('avatar', 'mediaImage', [
                'label'      => 'Ảnh chân dung',
                'label_attr' => ['class' => 'control-label required'],
            ])
;
            $this
                ->add('rowOpen1', 'html', [
                    'html' => '<div class="row">',
                ])
                ->add('avatar_toan_than_1', 'mediaImage', [
                    'label'      => 'Ảnh toàn thân 1',
                    'label_attr' => ['class' => 'control-label required'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-6',
                    ],
                ])
                ->add('avatar_toan_than_2', 'mediaImage', [
                    'label'      => 'Ảnh toàn thân 2',
                    'label_attr' => ['class' => 'control-label required'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-6',
                    ],
                ])
                ->add('rowClose1', 'html', [
                    'html' => '</div>',
                ]);
                $this
                ->add('rowOpen2', 'html', [
                    'html' => '<div class="row">',
                ])
                ->add('anh_1', 'mediaImage', [
                    'label'      => 'Ảnh khác',
                    'label_attr' => ['class' => 'control-label '],
                    'wrapper'    => [
                        'class' => 'form-group col-md-2',
                    ],
                ])
                ->add('anh_2', 'mediaImage', [
                    // 'label'      => 'Ảnh toàn thân 2',
                    'label_attr' => ['class' => 'control-label'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-2',
                    ],
                ])
                ->add('anh_3', 'mediaImage', [
                    // 'label'      => 'Ảnh toàn thân 2',
                    'label_attr' => ['class' => 'control-label'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-2',
                    ],
                ])
                ->add('anh_4', 'mediaImage', [
                    // 'label'      => 'Ảnh toàn thân 2',
                    'label_attr' => ['class' => 'control-label'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-2',
                    ],
                ])
                ->add('anh_5', 'mediaImage', [
                    // 'label'      => 'Ảnh toàn thân 2',
                    'label_attr' => ['class' => 'control-label'],
                    'wrapper'    => [
                        'class' => 'form-group col-md-2',
                    ],
                ])
                ->add('rowClose2', 'html', [
                    'html' => '</div>',
                ]);

    }
}
