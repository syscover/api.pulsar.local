<?php

return [

    //******************************************************************************************************************
    //***   FOCO
    //******************************************************************************************************************
    'modalities' => [
        (object)['id' => 1, 'name' => 'Modalidad I',    'code' => 'FPTO',   'inscription_type' => 3],
        (object)['id' => 2, 'name' => 'Modalidad II',   'code' => 'FPTD',   'inscription_type' => 4],
        (object)['id' => 3, 'name' => 'Modalidad III',  'code' => 'FPCI',   'inscription_type' => 5],
        (object)['id' => 4, 'name' => 'Modalidad IV',   'code' => 'FPDR',   'inscription_type' => 6],
        (object)['id' => 5, 'name' => 'Modalidad V',    'code' => 'FPFP',   'inscription_type' => null],
        (object)['id' => 6, 'name' => 'Modalidad VI',   'code' => 'FPPE',   'inscription_type' => null],
    ],

    'group_prefixes' => [
        (object)['id' => '002', 'name' => 'Albacete'],
        (object)['id' => '013', 'name' => 'Ciudad Real'],
        (object)['id' => '016', 'name' => 'Cuenca'],
        (object)['id' => '019', 'name' => 'Guadalajara'],
        (object)['id' => '045', 'name' => 'Toledo']
    ],

    // Tables:
    // - forem_inscription.languages :: <id_idioma></id_idioma>
    'languages' => [
        (object)['id' => 1, 'name' => 'Inglés'],
        (object)['id' => 2, 'name' => 'Alemán'],
        (object)['id' => 3, 'name' => 'Francés'],
        (object)['id' => 4, 'name' => 'Italiano'],
        (object)['id' => 5, 'name' => 'Otros']
    ],

    // Tables:
    // - forem_inscription.languages :: <titulacion_idioma></titulacion_idioma>
    'language_certificate' => [
        (object)['id' => 1, 'name' => 'A1'],
        (object)['id' => 2, 'name' => 'B1'],
        (object)['id' => 3, 'name' => 'C1'],
        (object)['id' => 4, 'name' => 'A2'],
        (object)['id' => 5, 'name' => 'B2'],
        (object)['id' => 6, 'name' => 'C2'],
    ],

    // Tables:
    // - forem_inscription.languages :: <destreza_hablar_idioma></destreza_hablar_idioma>
    'language_skill' => [
        (object)['id' => 477, 'name' => 'Básico'],
        (object)['id' => 478, 'name' => 'Medio'],
        (object)['id' => 479, 'name' => 'Avanzado']
    ],

    // Tables:
    // - forem_inscription.academic_level_id :: <id_nivel_academico></id_nivel_academico>
    'academic_levels' => [
        (object)['id' => 1,     'academic_id' => 1,     'modality_id' => [3,4,5,6,7], 'name' => 'Sin estudios',                           'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 2,     'academic_id' => 2,     'modality_id' => [3,4,5,6,7], 'name' => 'Estudios primarios',                     'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 3,     'academic_id' => 3,     'modality_id' => [3,4,5,6,7], 'name' => 'Graduado escolar',                       'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 4,     'academic_id' => 4,     'modality_id' => [3,4,5,6,7], 'name' => 'ESO',                                    'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 5,     'academic_id' => 5,     'modality_id' => [3,4,5,6,7], 'name' => 'FP I',                                   'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 7,     'academic_id' => 7,     'modality_id' => [3,4,5,6,7], 'name' => 'Ciclo grado superior',                   'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 8,     'academic_id' => 8,     'modality_id' => [3,4,5,6,7], 'name' => 'BUP/COU/Bachillerato',                   'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => '02/06/2014'],
        (object)['id' => 9,     'academic_id' => 9,     'modality_id' => [3,4,5,6,7], 'name' => 'Diplomatura',                            'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 10,    'academic_id' => 10,    'modality_id' => [3,4,5,6,7], 'name' => 'Licenciatura',                           'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 31,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Doctor',                                 'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 32,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Otros',                                  'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 33,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Certificado de profesionalidad nivel 1', 'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 34,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Certificado de profesionalidad nivel 2', 'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 35,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Certificado de profesionalidad nivel 3', 'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 36,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Certificado de escolaridad',             'specialty' => false,   'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 37,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'FP II',                                  'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 38,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Ciclo grado medio',                      'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 39,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Grado',                                  'specialty' => true,    'date_from' => '01/01/2004', 'date_to' => null],
        (object)['id' => 40,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'BUP (1º y 2º curso)',                    'specialty' => false,   'date_from' => '03/06/2014', 'date_to' => null],
        (object)['id' => 41,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'BUP (1º, 2º y 3º curso)',                'specialty' => false,   'date_from' => '03/06/2014', 'date_to' => null],
        (object)['id' => 42,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'COU',                                    'specialty' => false,   'date_from' => '03/06/2014', 'date_to' => null],
        (object)['id' => 43,    'academic_id' => null,  'modality_id' => [3,4,5,6,7], 'name' => 'Bachiller',                              'specialty' => false,   'date_from' => '03/06/2014', 'date_to' => null],
    ],

    // Tables:
    // - forem_inscription.driving_licenses :: <id_carnet_conducir></id_carnet_conducir>
    'driving_licenses' => [
        (object)['id' => 1, 'name' => 'AM'],
        (object)['id' => 2, 'name' => 'A1'],
        (object)['id' => 3, 'name' => 'A2'],
        (object)['id' => 4, 'name' => 'A'],
        (object)['id' => 5, 'name' => 'B'],
        (object)['id' => 6, 'name' => 'BTP'],
        (object)['id' => 7, 'name' => 'B+E'],
        (object)['id' => 8, 'name' => 'C1'],
        (object)['id' => 9, 'name' => 'C1+E'],
        (object)['id' => 10, 'name' => 'C'],
        (object)['id' => 11, 'name' => 'C+E'],
        (object)['id' => 12, 'name' => 'D1'],
        (object)['id' => 13, 'name' => 'D1+E'],
        (object)['id' => 14, 'name' => 'D'],
        (object)['id' => 15, 'name' => 'D+E'],
    ],

    // Tables:
    // - forem_inscription.road_type_id :: <id_tipo_via></id_tipo_via>
    'type_roads' => [
        (object)['id' => 1,     'code' => 'AD',   'name' => 'Aldea'],
        (object)['id' => 2,     'code' => 'AL',   'name' => 'Alameda'],
        (object)['id' => 3,     'code' => 'AP',   'name' => 'Apartamento'],
        (object)['id' => 4,     'code' => 'AV',   'name' => 'Avenida'],
        (object)['id' => 5,     'code' => 'BA',   'name' => 'Bajada'],
        (object)['id' => 6,     'code' => 'BL',   'name' => 'Bloque'],
        (object)['id' => 7,     'code' => 'BO',   'name' => 'Barrio'],
        (object)['id' => 8,     'code' => 'CA',   'name' => 'Calleja'],
        (object)['id' => 9,     'code' => 'CC',   'name' => 'Centro comercial'],
        (object)['id' => 10,    'code' => 'CH',   'name' => 'Chalet'],
        (object)['id' => 11,    'code' => 'CJ',   'name' => 'Callejón'],
        (object)['id' => 12,    'code' => 'CL',   'name' => 'Calle'],
        (object)['id' => 13,    'code' => 'CM',   'name' => 'Camino'],
        (object)['id' => 14,    'code' => 'CO',   'name' => 'Colonia'],
        (object)['id' => 15,    'code' => 'CR',   'name' => 'Carretera'],
        (object)['id' => 16,    'code' => 'CS',   'name' => 'Caserío'],
        (object)['id' => 17,    'code' => 'CT',   'name' => 'Cuesta'],
        (object)['id' => 18,    'code' => 'ED',   'name' => 'Edificio'],
        (object)['id' => 19,    'code' => 'GL',   'name' => 'Glorieta'],
        (object)['id' => 20,    'code' => 'GR',   'name' => 'Grupo'],
        (object)['id' => 21,    'code' => 'LU',   'name' => 'Lugar'],
        (object)['id' => 22,    'code' => 'ME',   'name' => 'Mercado'],
        (object)['id' => 23,    'code' => 'MU',   'name' => 'Municipio'],
        (object)['id' => 24,    'code' => 'MZ',   'name' => 'Manzana'],
        (object)['id' => 25,    'code' => 'PA',   'name' => 'Paseo alto'],
        (object)['id' => 26,    'code' => 'PB',   'name' => 'Poblado'],
        (object)['id' => 27,    'code' => 'PG',   'name' => 'Poligono'],
        (object)['id' => 28,    'code' => 'PJ',   'name' => 'Pasaje'],
        (object)['id' => 29,    'code' => 'PQ',   'name' => 'Parque'],
        (object)['id' => 30,    'code' => 'PZ',   'name' => 'Plaza'],
        (object)['id' => 31,    'code' => 'PR',   'name' => 'Prolongación'],
        (object)['id' => 32,    'code' => 'PS',   'name' => 'Paseo'],
        (object)['id' => 33,    'code' => 'RB',   'name' => 'Rambla'],
        (object)['id' => 34,    'code' => 'RD',   'name' => 'Ronda'],
        (object)['id' => 35,    'code' => 'TR',   'name' => 'Travesía'],
        (object)['id' => 36,    'code' => 'UR',   'name' => 'Urbanización']
    ],

    // Tables:
    // - forem_inscription.gender_id :: <sexo></sexo>
    'genders' => [
        (object)['id' => 0, 'name' => 'Hombre'],
        (object)['id' => 1, 'name' => 'Mujer']
    ],

    // Tables:
    // - forem_inscription.document_type_id :: <id_tipo_documento_alumno></id_tipo_documento_alumno>
    'document_types' => [
        (object)['id' => 1, 'name' => 'NAF'],
        (object)['id' => 2, 'name' => 'ISFAS'],
        (object)['id' => 3, 'name' => 'MUTUALISTA']
    ],

    // Tables:
    // - forem_inscription.employment_situation_id :: <id_situacion_laboral></id_situacion_laboral>
    'employment_situations' => [
        (object)['id' => 0, 'name' => 'Desempleado'],
        (object)['id' => 1, 'name' => 'Ocupado'],
        (object)['id' => 2, 'name' => 'Otra']
    ],

    // Tables:
    // - forem_inscription.unemployed_situation_id :: <id_situacion_desempleo></id_situacion_desempleo>
    'unemployed_situations' => [
        (object)['id' => 67,    'name' => 'Percibe prestación por desempleo'],
        (object)['id' => 68,    'name' => 'Percibe subsidio por desempleo'],
        (object)['id' => 69,    'name' => 'En paro sin prestación de subsidio'],
        (object)['id' => 70,    'name' => 'Demandante del primer empleo'],
        (object)['id' => 144,   'name' => 'Otros no parados'],
    ],

    // Tables:
    // - forem_inscription.professional_category_id :: <id_categoria_profesional></id_categoria_profesional>
    'professional_categories' => [
        (object)['id' => 1, 'name' => 'Directivos/as'],
        (object)['id' => 2, 'name' => 'Mandos intermedios'],
        (object)['id' => 3, 'name' => 'Técnicos/as'],
        (object)['id' => 4, 'name' => 'Trabajadores cualificados/as'],
        (object)['id' => 5, 'name' => 'Trabajadores no cualificados/as'],
    ],

    // Tables:
    // - forem_inscription.id_area_funcional :: <id_area_funcional></id_area_funcional>
    'functional_areas' => [
        (object)['id' => 1, 'name' => 'Dirección'],
        (object)['id' => 2, 'name' => 'Administración'],
        (object)['id' => 3, 'name' => 'Comercial'],
        (object)['id' => 4, 'name' => 'Mantenimiento'],
        (object)['id' => 5, 'name' => 'Producción'],
    ],

    // Tables:
    // - forem_inscription.reason_request_id :: <id_motivo_solicitud></id_motivo_solicitud>
    'reason_requests' => [
        (object)['id' => 1, 'name' => 'Interés'],
        (object)['id' => 2, 'name' => 'No perder prestaciones'],
        (object)['id' => 3, 'name' => 'Mejorar la cualificación'],
        (object)['id' => 4, 'name' => 'Para encontrar trabajo'],
        (object)['id' => 5, 'name' => 'Cambio de sector o actividad'],
        (object)['id' => 6, 'name' => 'Otros'],
    ],

    'sectors' => [
        (object)['id' => 1, 'name' => 'Industrias de captación, elevación, conducción, tratamiento, depuración y distribución de agua'],
        (object)['id' => 2, 'name' => 'Industrias de alimentación y bebidas'],
        (object)['id' => 3, 'name' => 'Artes gráficas, manipulados de papel y cartón, editoriales e industrias afines'],
        (object)['id' => 4, 'name' => 'Banca'],
        (object)['id' => 5, 'name' => 'Comercio'],
        (object)['id' => 6, 'name' => 'Construccion'],
    ],


    //******************************************************************************************************************
    //***   FOREM
    //******************************************************************************************************************

    // Tables:
    // - forem_action.target_id
    // - forem_group.target_id
    'targets' => [
        (object)['id' => 1, 'name' => 'Desempleados/as'],
        (object)['id' => 2, 'name' => 'Ocupados/as'],
        (object)['id' => 3, 'name' => 'Desempleados/as y Ocupados/as'],
    ],

    // Tables:
    // - forem_action.assistance_id
    // - forem_group.assistance_id
    'assistances' => [
        (object)['id' => 1, 'name' => 'Presencial'],
        (object)['id' => 2, 'name' => 'Teleformación'],
        (object)['id' => 3, 'name' => 'Mixta'],
    ],

    // Tables:
    // - forem_action.type_id
    // - forem_group.type_id
    'types' => [
        (object)['id' => 1, 'name' => 'Formacion no subvencionada',         'slug' => 'formacion-no-subvencionada'],
        (object)['id' => 2, 'name' => 'Formacion subvencionada',            'slug' => 'formacion-subvencionada'],
        (object)['id' => 3, 'name' => 'Oposiciones',                        'slug' => 'oposiciones'],
    ],

    'work_situations' => [
        (object)['id' => 1, 'name' => 'Desempleado/a'],
        (object)['id' => 2, 'name' => 'Trabajador/a área pública'],
        (object)['id' => 3, 'name' => 'Trabajador/a ERE (Expediente de Regulación de Empleo)'],
        (object)['id' => 4, 'name' => 'Trabajador/a no PYME (Más de 250 trabajadores)'],
        (object)['id' => 5, 'name' => 'Trabajador/a PYME (Menos de 250 trabajadores)'],
    ],
    'expertises' => [
        (object)['id' => 1, 'name' => '3 Años trabajando o más'],
        (object)['id' => 2, 'name' => 'De 1 a 3 años trabajados'],
        (object)['id' => 3, 'name' => 'Menos de 1 año tarbajado'],
        (object)['id' => 4, 'name' => 'Ninguna']
    ],
    'trainings' => [
        (object)['id' => 1, 'name' => 'Ninguna'],
        (object)['id' => 2, 'name' => 'De 1 a 100 horas'],
        (object)['id' => 3, 'name' => 'De 100 a 300 horas'],
        (object)['id' => 4, 'name' => '300 horas o más']
    ],

    //******************************************************************************************************************
    //***   FORMADORES
    //******************************************************************************************************************
    'profiles' => [
        (object)['id' => 1, 'name' => 'Formador/a'],
        (object)['id' => 2, 'name' => 'Proyectos'],
    ],
    'availabilities' => [
        (object)['id' => 1, 'name' => 'Formación Online'],
        (object)['id' => 2, 'name' => 'Albacete'],
        (object)['id' => 3, 'name' => 'Castilla la Mancha'],
        (object)['id' => 4, 'name' => 'Ciudad Real'],
        (object)['id' => 5, 'name' => 'Cuenca'],
        (object)['id' => 6, 'name' => 'Guadalajara'],
        (object)['id' => 7, 'name' => 'Toledo'],
    ],
];
