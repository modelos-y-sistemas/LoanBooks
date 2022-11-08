<?php
$query = "
  SELECT
    `id_course`,
    `year`,
    `division`,
    CASE
      WHEN (`modality` = 1) THEN 'INFORMATICA'
      ELSE
        CASE
          WHEN (`modality` = 2) THEN 'TURISMO'
          ELSE
            CASE
              WHEN (`modality` = 3) THEN 'ALIMENTOS'
              ELSE
                CASE
                  WHEN (`modality` = 0) THEN 'CICLO BASICO'
                  ELSE NULL
                END
            END
        END
    END AS 'modality'
  FROM `courses_t`;";
