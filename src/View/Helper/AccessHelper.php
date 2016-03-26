<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AccessHelper extends Helper {
    
    public function display($level) {
        $access = '';
        if ($level === 0) {
            $access = '(0) Public';
        } else if ($level === 1) {
            $access = '<span style="color: #5EB82A">(1) Client Account Creative Admin</span>';
        } else if ($level === 2) {
            $access = '<span style="color: #DBAB00">(2) Account Creative Admin</span>';
        } else if ($level === 3) {
            $access = '<span style="color: #C56B10">(3) Creative Admin</span>';
        } else if ($level === 4) {
            $access = '<span style="color: #9C0010">(4) Only Admin</span>';
        }
        
        return $access;
    }
    
    public function options($level) {
        $options = [];
        if ($level == 4) {
            $options += [
                '4' => 'Only Admin',
            ];
        }
        if ($level >= 3) {
            $options += [
                '3' => 'Creative Admin',
            ];
        }
        if ($level >= 2) {
            $options += [
                '2' => 'Account Creative Admin',
                '1' => 'Client Account Creative Admin',
                '0' => 'Public'
            ];
        }
        return $options;
    }
}