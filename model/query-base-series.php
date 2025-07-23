<?php

$select_series = "series.pk AS pk_series,
series.series_iuid, 
series.series_desc, 
series.laterality,
series.body_part, 
series.src_aet,
series.modality, 
series.department,
series.num_instances, 
series.created_time,
series.updated_time";

$table_series = "$database_pacsio.series AS series";
