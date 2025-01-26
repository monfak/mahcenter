<?php
namespace App\Utilities;

class MenuFactory {

    /**
     * Builds hierarchy menu.
     *
     * @return array $menu menu
     */
    public static function build(){
        $menus = [
            [
                'label' => 'داشبورد',
                'permissions' => ['access-dashboard'],
                'icon' => 'dashboard',
                'route_name' => 'admin.app.index',
            ],
            [
                'label' => 'فروشگاه',
                'permissions' => ['categories-manage', 'filters-manage', 'attributes-manage', 'options-manage', 'manufacturers-manage', 'products-manage', 'reviews-manage', 'questions-manage'],
                'icon' => 'tags',
                'badges' => [['color' => 'label-primary', 'var' => 'pendingReviewsCount']],
                'children' => [
                    [
                        'route_name' => 'admin.categories.index',
                        'label' => 'دسته‌بندی‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['categories-manage'],
                    ],
                    [
                        'route_name' => 'admin.filters.index',
                        'label' => 'فیلترها',
                        'icon' => 'circle-o',
                        'permissions' => ['filters-manage'],
                    ],
                    [
                        'route_name' => 'admin.attributes.index',
                        'label' => 'خصوصیات',
                        'icon' => 'circle-o',
                        'permissions' => ['attributes-manage'],
                    ],
                    [
                        'route_name' => 'admin.manufacturers.index',
                        'label' => 'تولیدکنندگان',
                        'icon' => 'circle-o',
                        'permissions' => ['manufacturers-manage'],
                    ],
                    [
                        'route_name' => 'admin.products.index',
                        'label' => 'محصولات',
                        'icon' => 'circle-o',
                        'permissions' => ['products-manage'],
                    ],
                    [
                        'route_name' => 'admin.reviews.index',
                        'label' => 'نظرات محصولات',
                        'icon' => 'circle-o',
                        'badges' => [['color' => 'label-primary', 'var' => 'pendingReviewsCount']],
                        'permissions' => ['reviews-manage'],
                    ],
                    [
                        'route_name' => 'admin.questions.index',
                        'label' => 'پرسش و پاسخ',
                        'icon' => 'circle-o',
                        'permissions' => ['questions-manage'],
                    ],
                    [
                        'route_name' => 'admin.warranties.index',
                        'label' => 'گارانتی‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['warranties-manage'],
                    ],
                ]
            ],
            [
                'label' => 'لجستیک',
                'permissions' => ['provinces-manage', 'cities-manage', 'districts-manage', 'delivery-methods-manage'],
                'icon' => 'truck',
                'children' => [
                    [
                        'route_name' => 'admin.provinces.index',
                        'label' => 'استان‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['provinces-manage'],
                    ],
                    [
                        'route_name' => 'admin.cities.index',
                        'label' => 'شهرها',
                        'icon' => 'circle-o',
                        'permissions' => ['cities-manage'],
                    ],
                    [
                        'route_name' => 'admin.districts.index',
                        'label' => 'محله‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['districts-manage'],
                    ],
                    [
                        'route_name' => 'admin.delivery-methods.index',
                        'label' => 'روش‌های ارسال',
                        'icon' => 'circle-o',
                        'permissions' => ['delivery-methods-manage'],
                    ],
                ]
            ],
            [
                'label' => 'فروش',
                'permissions' => ['carts-manage', 'orders-manage', 'payments-manage'],
                'icon' => 'shopping-cart',
                'badges' => [['color' => 'bg-green', 'var' => 'uncheckedOrdersCount']],
                'children' => [
                    [
                        'route_name' => 'admin.carts.index',
                        'label' => 'سبدهای خرید',
                        'icon' => 'circle-o',
                        'permissions' => ['carts-manage'],
                    ],
                    [
                        'route_name' => 'admin.orders.index',
                        'label' => 'سفارش‌ها',
                        'icon' => 'circle-o',
                        'badges' => [['color' => 'bg-green', 'var' => 'uncheckedOrdersCount']],
                        'permissions' => ['orders-manage'],
                    ],
                    [
                        'route_name' => 'admin.payments.index',
                        'label' => 'پرداخت‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['payments-manage'],
                    ],
                ]
            ],
            [
                'label' => 'مالی',
                'permissions' => ['transactions-manage', 'wallets-manage', 'payment-methods-manage'],
                'icon' => 'money',
                'children' => [
                    [
                        'route_name' => 'admin.wallets.index',
                        'label' => 'کیف پول‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['wallets-manage'],
                    ],
                    [
                        'route_name' => 'admin.transactions.index',
                        'label' => 'تراکنش‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['transactions-manage'],
                    ],
                    [
                        'route_name' => 'admin.payment-methods.index',
                        'label' => 'روش‌های پرداخت',
                        'icon' => 'circle-o',
                        'permissions' => ['payment-methods-manage'],
                    ],
                ]
            ],
            [
                'label' => 'محتوا',
                'permissions' => ['pages-manage', 'categories-manage', 'articles-manage', 'faqs-manage'],
                'icon' => 'book',
                'children' => [
                    [
                        'route_name' => 'admin.pages.index',
                        'label' => 'صفحات',
                        'icon' => 'circle-o',
                        'permissions' => ['pages-manage'],
                    ],
                    [
                        'route_name' => 'admin.article_category.index',
                        'label' => 'دسته بندی مقالات',
                        'icon' => 'circle-o',
                        'permissions' => ['categories-manage'],
                    ],
                    [
                        'route_name' => 'admin.articles.index',
                        'label' => 'مقالات',
                        'icon' => 'circle-o',
                        'permissions' => ['articles-manage'],
                    ],
                    [
                        'route_name' => 'admin.comments.index',
                        'label' => 'نظرات مقالات',
                        'icon' => 'circle-o',
                        //'badges' => [['color' => 'label-primary', 'var' => 'pendingReviewsCount']],
                        'permissions' => ['comments-manage'],
                    ],
                    [
                        'route_name' => 'admin.faqs.index',
                        'label' => 'سوالات متداول',
                        'icon' => 'circle-o',
                        'permissions' => ['faqs-manage'],
                    ],

                ]
            ],
            [
                'label' => 'طراحی',
                'permissions' => ['menus-manage', 'banners-manage', 'slider-manage'],
                'icon' => 'paint-brush',
                'children' => [
                    [
                        'route_name' => 'admin.menus.index',
                        'label' => 'منوها',
                        'icon' => 'circle-o',
                        'permissions' => ['menus-manage'],
                    ],
                    [
                        'route_name' => 'admin.banners.index',
                        'label' => 'بنرها',
                        'icon' => 'circle-o',
                        'permissions' => ['banners-manage'],
                    ],
                    [
                        'route_name' => 'admin.slides.index',
                        'label' => 'اسلایدر',
                        'icon' => 'circle-o',
                        'permissions' => ['slider-manage'],
                    ],
                ]
            ],
            [
                'label' => 'پشتیبانی',
                'permissions' => ['tickets-manage'],
                'icon' => 'ticket',
                'badges' => [['color' => 'bg-green', 'var' => 'openTicketsCount']],
                'children' => [
                    [
                        'route_name' => 'admin.tickets.index',
                        'label' => 'تیکت‌ها',
                        'icon' => 'circle-o',
                        'badges' => [['color' => 'bg-green', 'var' => 'openTicketsCount']],
                        'permissions' => ['tickets-manage'],
                    ],
                ]
            ],
            [
                'label' => 'کاربران',
                'permissions' => ['users-manage', 'roles-manage'],
                'icon' => 'users',
                'children' => [
                    [
                        'route_name' => 'admin.users.index',
                        'label' => 'کاربران',
                        'icon' => 'circle-o',
                        'permissions' => ['users-manage'],
                    ],
                    [
                        'route_name' => 'admin.roles.index',
                        'label' => 'نقش‌های کاربری',
                        'icon' => 'circle-o',
                        'permissions' => ['roles-manage'],
                    ],
                    [
                        'route_name' => 'admin.verifications.index',
                        'label' => 'کدهای وریفیکیشن',
                        'icon' => 'circle-o',
                        'permissions' => ['verifications-manage'],
                    ],
                ],
            ],
            [
                'label' => 'مارکتینگ',
                'permissions' => ['discounts-manage', 'newsletter-manage', 'festival-manage'],
                'icon' => 'bullhorn',
                'children' => [
                    [
                        'route_name' => 'admin.discounts.index',
                        'label' => 'تخفیف‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['discounts-manage'],
                    ],
                    [
                        'route_name' => 'admin.settings.festival.index',
                        'label' => 'جشنواره',
                        'icon' => 'circle-o',
                        'permissions' => ['festival-manage'],
                    ],
                    [
                        'route_name' => 'admin.newsletter.index',
                        'label' => 'خبرنامه',
                        'icon' => 'circle-o',
                        'permissions' => ['newsletter-manage'],
                    ],
                ],
            ],
            [
                'label' => 'سئو',
                'permissions' => ['redirects-manage', 'settings-seo', 'robots-manage'],
                'icon' => 'search',
                'children' => [
                    [
                        'route_name' => 'admin.redirects.index',
                        'label' => 'ریدایرکت‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['redirects-manage'],
                    ],
                    [
                        'route_name' => 'admin.settings.seo.index',
                        'label' => 'تنظیمات',
                        'icon' => 'circle-o',
                        'permissions' => ['settings-seo'],
                    ],
                    [
                        'route_name' => 'admin.robots.index',
                        'label' => 'robots.txt',
                        'icon' => 'circle-o',
                        'permissions' => ['robots-manage'],
                    ],
                ],
            ],
            [
                'label' => 'اقساط',
                'permissions' => ['installments-settings', 'installments-month', 'installments-percent', 'installments-plans', 'installments-applications'],
                'icon' => 'calendar',
                'badges' => [['color' => 'bg-green', 'var' => 'unseenInstallmentsCount']],
                'children' => [
                    [
                        'route_name' => 'admin.settings.installment.month.index',
                        'label' => 'اقساط ماهیانه',
                        'icon' => 'circle-o',
                        'permissions' => ['installments-month'],
                    ],
                    [
                        'route_name' => 'admin.settings.installment.percent.index',
                        'label' => ' اقساط پیش پرداخت',
                        'icon' => 'circle-o',
                        'permissions' => ['installments-percent'],
                    ],
                    [
                        'route_name' => 'admin.installments.plans.index',
                        'label' => 'پلن‌های اقساط',
                        'icon' => 'circle-o',
                        'permissions' => ['installments-plans'],
                    ],
                    [
                        'route_name' => 'admin.installments.applications.index',
                        'label' => 'درخواست‌های اقساط',
                        'icon' => 'circle-o',
                        'badges' => [['color' => 'bg-green', 'var' => 'unseenInstallmentsCount']],
                        'permissions' => ['installments-applications'],
                    ],
                    [
                        'route_name' => 'admin.settings.installment.index',
                        'label' => 'تنظیمات',
                        'icon' => 'circle-o',
                        'permissions' => ['installments-settings'],
                    ],
                ],
            ],
            [
                'label' => 'فروش عمده',
                'permissions' => ['b2b-settings'],
                'icon' => 'edit',
                'children' => [
                    [
                        'route_name' => 'admin.settings.b2b.index',
                        'label' => 'تنظیمات',
                        'icon' => 'circle-o',
                        'permissions' => ['b2b-settings'],
                    ],
                ],
            ],
            [
                'label' => 'گزارشات',
                'permissions' => ['reports-manage', 'logs-manage'],
                'icon' => 'pie-chart',
                'children' => [
                    [
                        'route_name' => 'admin.reports.index',
                        'label' => 'گزارشات',
                        'icon' => 'circle-o',
                        'permissions' => ['reports-manage'],
                    ],
                    [
                        'route_name' => 'admin.logs.index',
                        'label' => 'لاگ فعالیت‌ها',
                        'icon' => 'circle-o',
                        'permissions' => ['logs-manage'],
                    ],
                ],
            ],
            [
                'label' => 'تنظیمات',
                'permissions' => ['settings-general', 'settings-socials', 'logs-manage'],
                'icon' => 'cog',
                'children' => [
                    [
                        'route_name' => 'admin.settings.index',
                        'label' => 'عمومی',
                        'icon' => 'circle-o',
                        'permissions' => ['settings-general'],
                    ],
                    [
                        'route_name' => 'admin.settings.socials.index',
                        'label' => 'شبکه‌های اجتماعی',
                        'icon' => 'circle-o',
                        'permissions' => ['settings-socials'],
                    ],
                ],
            ],
        ];

        $currentRouteName = app('router')->getCurrentRoute()->getName();

        foreach($menus as &$menu) {
            if(isset($menu['route_name']) && $currentRouteName == $menu['route_name']) {
                $menu['active'] = true;
            }

            if(isset($menu['children']) && $menu['children']) {
                foreach($menu['children'] as &$child) {
                    if(isset($child['route_name']) && $currentRouteName == $child['route_name']) {
                        $menu['active'] = true;
                        $child['active'] = true;
                    }

                    if(isset($menu['permissions']) && $child['permissions']) {
                        $menu['permissions'] = array_merge($menu['permissions'], $child['permissions']);
                    }
                }
            }
        }
        return $menus;
    }

    /**
     * Puts user permissions in an array.
     *
     * @return array $user_permissions Permissions of the current user
     */
    public static function userPermissions()
    {
        $userRoles = auth()->user()->roles;
        $permissions = [];

        foreach($userRoles as $userRole)
        {
            $user_permissions = $userRole->permissions()->pluck('name')->toArray();
            foreach ($user_permissions as $permission)
            {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}
