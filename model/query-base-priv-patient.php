<?php

$select_priv_patient = "priv_patient.pk AS pk_priv_patient,
priv_patient.priv_type AS priv_type_patient,
priv_patient.pat_id,
priv_patient.pat_id_issuer,
priv_patient.pat_name";

$table_priv_patient = "$database_pacsio.priv_patient AS priv_patient";
