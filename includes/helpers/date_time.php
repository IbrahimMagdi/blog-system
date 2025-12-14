<?php
if(!function_exists('time_ago')){
    function time_ago($datetime, $full = false) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        // لو التاريخ في المستقبل
        if($ago > $now){
            return trans('date_time.just_now');
        }

        // حساب الأسابيع
        $weeks = floor($diff->d / 7);
        $days = $diff->d - ($weeks * 7);

        // القيم الفعلية
        $periods = [
            'y' => $diff->y,
            'm' => $diff->m,
            'w' => $weeks,
            'd' => $days,
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s,
        ];

        $result = [];
        
        // بناء النص
        foreach ($periods as $key => $value) {
            if ($value > 0) {  // الشرط الصحيح ✅
                $translation = trans('date_time.' . $key);
                $parts = explode('|', $translation);
                $singular = $parts[0];
                $plural = isset($parts[1]) ? $parts[1] : $singular . 's';
                
                $word = ($value > 1) ? $plural : $singular;
                $result[] = $value . ' ' . $word;
            }
        }

        // لو مش عاوز كل التفاصيل
        if (!$full && !empty($result)) {
            $result = array_slice($result, 0, 1);
        }
        
        // لو مفيش أي فرق
        if(empty($result)){
            return trans('date_time.just_now');
        }
        
        // تركيب النص النهائي
        $timeString = implode(', ', $result);
        return sprintf(trans('date_time.suffix'), $timeString);
    }
}
?>