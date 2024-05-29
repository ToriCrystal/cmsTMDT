<?php

namespace Database\Seeders;

use App\Enums\Setting\SettingGroup;
use App\Enums\Setting\SettingTypeInput;
use App\Enums\User\AutoNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_name' => 'Tên site',
                'plain_value' => 'Site name',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
                'desc' => 'Tên của website, shop, app'
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/assets/images/logo.png',
                'type_input' => SettingTypeInput::Image,
                'group' => SettingGroup::General,
                'desc' => 'Logo thương hiệu'
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'mevivu@gmail.com',
                'type_input' => SettingTypeInput::Email,
                'group' => SettingGroup::General,
                'desc' => 'Email liên hệ'
            ],
            [
                'setting_key' => 'hotline',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0999999999',
                'type_input' => SettingTypeInput::Phone,
                'group' => SettingGroup::General,
                'desc' => 'Số điện thoại liên lạc.'
            ],
            [
                'setting_key' => 'bank_name',
                'setting_name' => 'Tài khoản ngân hàng',
                'plain_value' => '0999999999',
                'type_input' => SettingTypeInput::Number,
                'group' => SettingGroup::General,
                'desc' => 'Tài khoản ngân hàng.'
            ],
            [
                'setting_key' => 'address',
                'setting_name' => 'Địa chỉ',
                'plain_value' => '998/42/15 Quang Trung, GV',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
                'desc' => 'Địa chỉ liên lạc.'
            ],
            [
                'setting_key' => 'notification',
                'setting_name' => 'Thông báo',
                'plain_value' => 0,
                'type_input' => SettingTypeInput::Switch,
                'group' => SettingGroup::Appearance,
                'desc' => 'notification.'
            ],
            [
                'setting_key' => 'introduce',
                'setting_name' => 'Giới thiệu',
                'plain_value' => 'Giới thiệu',
                'type_input' => SettingTypeInput::Text,
                'group' => SettingGroup::General,
                'desc' => 'Giới thiệu.'
            ],
            [
                'setting_key' => 'system_commission_rate',
                'setting_name' => 'Tỉ lệ phần trăm hệ thống nhận được / đơn hàng (0.1 = 10%)',
                'plain_value' => 0.1,
                'type_input' => SettingTypeInput::Number,
                'group' => SettingGroup::System,
                'desc' => 'notification.'
            ],

        ]);
    }
}
