<?php
echo "<body onload='window.print()'>";
$i=1;
?>
<table cellspacing='1' cellpadding='0' bgcolor='#C6D7F2' border="1" width="100%" style="font-size: 20px;">
    <?php $all_money = 0;$all_money2 = 0; $all_days=0;?>
    <tr>
        <th width="20%">
            項目
        </th>
        <th width="15%">
            姓名
        </th>
        <th width="10%">
            單價
        </th>
        @foreach($lunch_orders as $lunch_order)
            <th>
                {{ substr($lunch_order->name,5,2) }}<br>月
            </th>
        @endforeach
        <th width="15%">
            總餐次
        </th>
        <th width="15%">
            總收費
        </th>
        <th>
            備註
        </th>
    </tr>
    @foreach($user_datas as $k1=>$v1)
        <?php $total_days=0; ?>
        <tr bgcolor='#FFFFFF'  bgcolor='#FFFFFF'>
            <td>
                {{ $lunch_setup->semester }} 學期
                教師午餐收費通知
            </td>
            <td>
                {{ $i }} - {{ $k1 }}<br>
            </td>
            <td>
                單價：{{ $lunch_setup->teacher_money }}
            </td>
            @foreach($lunch_orders as $lunch_order)
            <td>
                <?php
                if(!isset($user_datas_by_order[$k1][$lunch_order->id])) $user_datas_by_order[$k1][$lunch_order->id] = 0;
                ?>
                {{ $user_datas_by_order[$k1][$lunch_order->id] }}
                <?php
                    if(!isset($this_order[$lunch_order->id])) $this_order[$lunch_order->id] = 0;
                    $this_order[$lunch_order->id] += $user_datas_by_order[$k1][$lunch_order->id];
                ?>
            </td>
            @endforeach
            <td>
                <?php
                    foreach($v1 as $k2=>$v2){
                        $total_days += $v2;
                    }
                ?>
                餐次：{{ $total_days }}
                <?php $all_days += $total_days; ?>
            </td>
            <td>
                {{ round($lunch_setup->teacher_money*$total_days) }} 元<small>({{ $lunch_setup->teacher_money*$total_days }})</small>
                <?php
                $all_money+= round($lunch_setup->teacher_money*$total_days);
                $all_money2+= $lunch_setup->teacher_money*$total_days;
                ?>
            </td>
            <td>
                @if(!is_null($die_line))
                <p style="font-size: 15px;">
                {{ substr($die_line,5,5) }} 前繳交
                </p>
                @endif
            </td>
        </tr>
        <?php $i++; ?>
    @endforeach
    <tr>
        <td>合計</td>
        <td></td>
        <td>
        </td>
        @foreach($lunch_orders as $lunch_order)
        <td>
            {{ $this_order[$lunch_order->id] }}
        </td>
        @endforeach
        <td>{{ $all_days }}</td>
        <td>{{ $all_money }} 元<small>({{ $all_money2 }})</small></td>
        <td>
        </td>
    </tr>
</table>
