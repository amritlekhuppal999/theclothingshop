<div>
    @php
        echo "DATA: "; var_dump($categories); echo "<br /> <br />";
        echo "SQL: "; var_dump($sql); echo "<br /> <br />";
        echo "BINBDINGS: "; var_dump($bindings); echo "<br /> <br />";
        echo "ERROR: "; var_dump($error); echo "<br /> <br />";
    @endphp
</div>


{{-- 
select 
    `CAT`.`id` as `CATID`, `CAT`.`category_name`, `CAT`.`category_slug`, 
    `SCAT`.`id` as `SID`, `SCAT`.`sub_category_name`, `SCAT`.`sub_categroy_slug` 
from 
    `category` as `CAT` 
left join 
    `sub_category` as `SCAT` on `CAT`.`id` = `SCAT`.`category_id` and `SCAT`.`status` = 1 
where 
    `CAT`.`status` = 1 
--}}