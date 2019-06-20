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

    'steps' => [
        (object)['id' => 0, 'name' => 'Paso 1 - Información de contacto',   'active' => false],
        (object)['id' => 1, 'name' => 'Paso 2 - Información personal',      'active' => true],
        (object)['id' => 2, 'name' => 'Paso 3 - Información profesional',   'active' => true],
        (object)['id' => 3, 'name' => 'Paso 4 - Información académica',     'active' => true],
        (object)['id' => 4, 'name' => 'Paso 5 - Otros datos',               'active' => true]
    ],

    // Tables:
    // - forem_inscription.employment_office_id :: <id_oficina_empleo></id_oficina_empleo>
    'employment_offices' => [
        (object)['id' => 1, 'code' => 'OA02008910',   'name' => 'Alcaraz'],
        (object)['id' => 2, 'code' => 'OA02009910',   'name' => 'Almansa'],
        (object)['id' => 3, 'code' => 'OA02024910',   'name' => 'Casas Ibañez'],
        (object)['id' => 4, 'code' => 'OA02025910',   'name' => 'Caudete'],
        (object)['id' => 5, 'code' => 'OA02030910',   'name' => 'Elche de la Sierra'],
        (object)['id' => 6, 'code' => 'OA02037910',   'name' => 'Hellin'],
        (object)['id' => 7, 'code' => 'OA02069910',   'name' => 'La Roda'],
        (object)['id' => 8, 'code' => 'OA02003910',   'name' => 'Albacete-Cid'],
        (object)['id' => 9, 'code' => 'OA13005910',   'name' => 'Alcazar de San Juan'],
        (object)['id' => 10, 'code' => 'OA13011910',   'name' => 'Almaden'],
        (object)['id' => 11, 'code' => 'OA13013910',   'name' => 'Almagro'],
        (object)['id' => 12, 'code' => 'OA13034910',   'name' => 'Ciudad Real'],
        (object)['id' => 13, 'code' => 'OA13039910',   'name' => 'Daimiel'],
        (object)['id' => 14, 'code' => 'OA13079910',   'name' => 'La Solana'],
        (object)['id' => 15, 'code' => 'OA13053910',   'name' => 'Manzanares'],
        (object)['id' => 16, 'code' => 'OA13063910',   'name' => 'Piedrabuena'],
        (object)['id' => 17, 'code' => 'OA13071910',   'name' => 'Puertollano'],
        (object)['id' => 18, 'code' => 'OA13082910',   'name' => 'Tomelloso'],
        (object)['id' => 19, 'code' => 'OA13087910',   'name' => 'Valdepeñas'],
        (object)['id' => 20, 'code' => 'OA13093910',   'name' => 'Villanueva de los Infantes'],
        (object)['id' => 21, 'code' => 'OA16033910',   'name' => 'Belmonte'],
        (object)['id' => 22, 'code' => 'OA16052910',   'name' => 'Cañete'],
        (object)['id' => 23, 'code' => 'OA16078910',   'name' => 'Cuenca'],
        (object)['id' => 24, 'code' => 'OA16134910',   'name' => 'Montilla del Palancar'],
        (object)['id' => 25, 'code' => 'OA16203910',   'name' => 'Tarancón'],
        (object)['id' => 26, 'code' => 'OA19086910',   'name' => 'Cifuentes'],
        (object)['id' => 27, 'code' => 'OA19130910',   'name' => 'Guadalajara'],
        (object)['id' => 28, 'code' => 'OA19190910',   'name' => 'Molina de Aragón'],
        (object)['id' => 29, 'code' => 'OA19212910',   'name' => 'Pastrana'],
        (object)['id' => 30, 'code' => 'OA19257910',   'name' => 'Sigüenza'],
        (object)['id' => 31, 'code' => 'OA45106910',   'name' => 'Mora'],
        (object)['id' => 32, 'code' => 'OA45121910',   'name' => 'Ocaña'],
        (object)['id' => 33, 'code' => 'OA45142910',   'name' => 'Quitanar de la Orden'],
        (object)['id' => 34, 'code' => 'OA45165910',   'name' => 'Talavera de la Reina'],
        (object)['id' => 35, 'code' => 'OA45168910',   'name' => 'Toledo'],
        (object)['id' => 36, 'code' => 'OA45173910',   'name' => 'Torrijos'],
        (object)['id' => 37, 'code' => 'OA45185910',   'name' => 'Villacañas'],
        (object)['id' => 38, 'code' => 'OA02081910',   'name' => 'Villarrobledo'],
        (object)['id' => 39, 'code' => 'OA45081910',   'name' => 'Illescas'],
        (object)['id' => 40, 'code' => 'OA02003915',   'name' => 'Albacete-Cubas'],
        (object)['id' => 41, 'code' => 'OA19046910',   'name' => 'Azuqueca de Henares'],
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
        (object)['id' => 4, 'name' => 'A2'],
        (object)['id' => 2, 'name' => 'B1'],
        (object)['id' => 5, 'name' => 'B2'],
        (object)['id' => 3, 'name' => 'C1'],
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
    // - forem_inscription.address_type_id :: <id_tipo_via></id_tipo_via>
    'address_types' => [
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
        (object)['id' => 8, 'name' => 'Enseñanza privada'],
        (object)['id' => 9, 'name' => 'Sector de la industria eléctrica'],
        (object)['id' => 11, 'name' => 'Hostelería'],
        (object)['id' => 12, 'name' => 'Empresas consultoras de planificación, organización de empresas y contable'],
        (object)['id' => 14, 'name' => 'Metal'],
        (object)['id' => 15, 'name' => 'Madera'],
        (object)['id' => 16, 'name' => 'Peluquerías, institutos de belleza, gimnasios y similares'],
        (object)['id' => 17, 'name' => 'Puertos del estado y autoridades portuarias'],
        (object)['id' => 18, 'name' => 'Industrias químicas'],
        (object)['id' => 19, 'name' => 'Entidades aseguradoras, reaseguradoras y mutuas de accidentes de trabajo'],
        (object)['id' => 22, 'name' => 'Seguridad privada'],
        (object)['id' => 23, 'name' => 'Textil y de la confección'],
        (object)['id' => 25, 'name' => 'Sector agrario, forestal y pecuario'],
        (object)['id' => 26, 'name' => 'Autoescuelas'],
        (object)['id' => 28, 'name' => 'Residuos sólidos urbanos y limpieza viaria'],
        (object)['id' => 29, 'name' => 'Perfumería y afines'],
        (object)['id' => 30, 'name' => 'Centros de asistencia y educación infantil'],
        (object)['id' => 31, 'name' => 'Establecimientos financieros y de crédito'],
        (object)['id' => 32, 'name' => 'Marina mercante'],
        (object)['id' => 33, 'name' => 'Jardinería'],
        (object)['id' => 35, 'name' => 'Empresas de enseñanza privada sostenidas total o parcialmente con fondos púbicos'],
        (object)['id' => 36, 'name' => 'Curtido'],
        (object)['id' => 37, 'name' => 'Industrias fotográficas'],
        (object)['id' => 38, 'name' => 'Mediación de seguros privados'],
        (object)['id' => 39, 'name' => 'Frío industrial'],
        (object)['id' => 40, 'name' => 'Transporte de mercancías por carretera'],
        (object)['id' => 41, 'name' => 'Limpieza de edificios y locales'],
        (object)['id' => 42, 'name' => 'Industria del calzado'],
        (object)['id' => 44, 'name' => 'Minería'],
        (object)['id' => 45, 'name' => 'Colegios mayores universitarios'],
        (object)['id' => 47, 'name' => 'Oficinas de farmacia'],
        (object)['id' => 48, 'name' => 'Agencias de viajes'],
        (object)['id' => 49, 'name' => 'Estaciones de servicio'],
        (object)['id' => 50, 'name' => 'Centros de educación universitaria e investigación'],
        (object)['id' => 51, 'name' => 'Empresas de ingeniería y oficinas de estudios técnicos'],
        (object)['id' => 52, 'name' => 'Derivados del cemento'],
        (object)['id' => 53, 'name' => 'Transporte de enfermos y accidentados en ambulancia'],
        (object)['id' => 54, 'name' => 'Prensa no diaria'],
        (object)['id' => 55, 'name' => 'Empresas de trabajo temporal'],
        (object)['id' => 56, 'name' => 'Alquiler de vehículos con y sin conductor'],
        (object)['id' => 57, 'name' => 'Producción, manipulado y envasado para el comercio y exportación de cítricos, frutas, hortalizas, flores y plantas vivas'],
        (object)['id' => 58, 'name' => 'Transporte de viajeros por carretera'],
        (object)['id' => 59, 'name' => 'Transporte aéreo'],
        (object)['id' => 60, 'name' => 'Mataderos de aves y conejos'],
        (object)['id' => 61, 'name' => 'Corcho'],
        (object)['id' => 62, 'name' => 'Residencias privadas de personas mayores y del servicio de ayuda a domicilio'],
        (object)['id' => 63, 'name' => 'Empresas organizadoras del juego del bingo'],
        (object)['id' => 65, 'name' => 'Tejas y ladrillos'],
        (object)['id' => 66, 'name' => 'Producción audiovisual'],
        (object)['id' => 73, 'name' => 'Industrias extractivas, industrias del vidrio, industrias de la cerámica y el comercio exclusivista de los mismos materiales'],
        (object)['id' => 75, 'name' => 'Pastas, papel y cartón'],
        (object)['id' => 76, 'name' => 'Estiba y desestiba'],
        (object)['id' => 77, 'name' => 'Empresas operadoras de servicios de telecomunicaciones'],
        (object)['id' => 78, 'name' => 'Pesca y acuicultura'],
        (object)['id' => 100, 'name' => 'Empresas de publicidad'],
        (object)['id' => 101, 'name' => 'Aparcamientos'],
        (object)['id' => 103, 'name' => 'Empresas productoras de cementos'],
        (object)['id' => 104, 'name' => 'Exhibición cinematográfica'],
        (object)['id' => 105, 'name' => 'Fabricación de azulejos, pavimentos y baldosas cerámicas y afines'],
        (object)['id' => 106, 'name' => 'Yesos, escayolas, cales y sus prefabricados'],
        (object)['id' => 107, 'name' => 'Telemarketing'],
        (object)['id' => 108, 'name' => 'Industrias cárnicas'],
        (object)['id' => 109, 'name' => 'Ferralla'],
        (object)['id' => 110, 'name' => 'Cajas de ahorros'],
        (object)['id' => 111, 'name' => 'Granjas avícolas y otros animales'],
        (object)['id' => 112, 'name' => 'Entrega domiciliaria'],
        (object)['id' => 113, 'name' => 'Prensa diaria'],
        (object)['id' => 114, 'name' => 'Instalaciones deportivas'],
        (object)['id' => 116, 'name' => 'Actividades anexas al transporte'],
        (object)['id' => 117, 'name' => 'Marroquinería, repujados y similares'],
        (object)['id' => 118, 'name' => 'Oficinas y despachos'],
        (object)['id' => 119, 'name' => 'Sanidad'],
        (object)['id' => 120, 'name' => 'Servicios funerarios'],
        (object)['id' => 121, 'name' => 'Tintorerías y lavanderías'],
        (object)['id' => 122, 'name' => 'Servicios Otros'],
        (object)['id' => 124, 'name' => 'Agencias distribuidoras de gases licuados'],
        (object)['id' => 125, 'name' => 'Grandes almacenes'],
        (object)['id' => 126, 'name' => 'Tabacalera, S.A.'],
        (object)['id' => 127, 'name' => 'Acción e intervención social'],
        (object)['id' => 128, 'name' => 'Actividades recreativas'],
        (object)['id' => 129, 'name' => 'Conservas vegetales'],
        (object)['id' => 130, 'name' => 'Empleados de fincas urbanas'],
        (object)['id' => 131, 'name' => 'Gestión de salas de espectáculos'],
        (object)['id' => 132, 'name' => 'Gestión y mediación inmobiliaria'],
        (object)['id' => 133, 'name' => 'Gestorías administrativas'],
        (object)['id' => 134, 'name' => 'Grúas móviles y autopropulsadas'],
        (object)['id' => 135, 'name' => 'Servicio de atención a personas dependientes y desarrollo de la promoción de la autonomía personal'],
        (object)['id' => 136, 'name' => 'Centros y servicios de atención a personas con discapacidad'],
        (object)['id' => 137, 'name' => 'Recuperación de residuos y materias primas secundarias'],
    ],

    'durations' => [
        (object)['id' => 338, 'name' => 'Menos de 6 meses'],
        (object)['id' => 339, 'name' => 'De 6 meses a 1 año'],
        (object)['id' => 340, 'name' => 'De 1 año a 2 años'],
        (object)['id' => 408, 'name' => 'Mas de 2 años'],
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
