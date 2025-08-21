<?php

$select_priv_study = "priv_study.pk AS pk_priv_study,
priv_study.patient_fk,
priv_study.priv_type  AS priv_type_study,
priv_study.study_iuid,
priv_study.accession_no";

$table_priv_study = "$database_pacsio.priv_study AS priv_study";
