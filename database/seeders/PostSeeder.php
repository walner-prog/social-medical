<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            // Aquí van los posts como en el ejemplo anterior
            [
                'user_id' => 3,
                'category_id' => 1,
                'title' => 'Enfermedades Cardíacas Comunes y Cómo Afectan al Corazón',
                'slug' => Str::slug('Enfermedades Cardíacas Comunes y Cómo Afectan al Corazón'),
                'content' => <<<EOT
                Las enfermedades cardíacas representan uno de los mayores riesgos para la salud mundial. Estas afecciones afectan el funcionamiento normal del corazón y, en casos graves, pueden llevar a complicaciones fatales. Las enfermedades más comunes incluyen la insuficiencia cardíaca, la enfermedad arterial coronaria y los infartos de miocardio. Cada una de estas condiciones puede tener un impacto severo en la vida diaria de los pacientes, limitando su capacidad para realizar actividades cotidianas y afectando gravemente su calidad de vida.

                La insuficiencia cardíaca, por ejemplo, ocurre cuando el corazón no puede bombear suficiente sangre para satisfacer las necesidades del cuerpo. Esto puede llevar a la acumulación de líquidos en los pulmones, lo que causa dificultad para respirar y fatiga extrema. A menudo, los pacientes con insuficiencia cardíaca requieren un manejo continuo y cambios en el estilo de vida, como una dieta baja en sal y la administración de medicamentos que ayuden al corazón a trabajar de manera más eficiente.

                La enfermedad arterial coronaria es otra afección común, caracterizada por el estrechamiento de las arterias que suministran sangre al corazón. Este problema se desarrolla cuando se acumula placa en las paredes de las arterias, reduciendo el flujo sanguíneo. Con el tiempo, esta falta de oxígeno puede dañar el músculo cardíaco, lo que aumenta el riesgo de un ataque al corazón. Los pacientes con esta condición deben seguir un régimen estricto de medicamentos y, en algunos casos, pueden necesitar procedimientos quirúrgicos como la angioplastia o la colocación de stents.

                Otro de los eventos cardíacos más graves es el infarto de miocardio, conocido comúnmente como un ataque al corazón. Durante un infarto, una arteria coronaria se bloquea repentinamente, lo que priva al corazón de oxígeno. La rapidez con la que se recibe tratamiento es crucial para minimizar el daño al músculo cardíaco. Las personas que sobreviven a un infarto pueden necesitar cambios drásticos en su estilo de vida, así como una estrecha vigilancia médica.

                Aunque las enfermedades cardíacas son una preocupación global, muchas de estas afecciones se pueden prevenir o manejar con un estilo de vida saludable. La combinación de una dieta adecuada, ejercicio regular y la gestión del estrés puede ayudar significativamente a reducir los riesgos de enfermedades cardíacas y a mantener el corazón funcionando de manera eficiente a lo largo de los años.
                EOT,
            ],

            [
                'user_id' => 3,
                'category_id' => 1,
                'title' => 'La Relación entre Estrés y Enfermedades Cardíacas',
                'slug' => Str::slug('La Relación entre Estrés y Enfermedades Cardíacas'),
                'content' => <<<EOT
                El estrés es una de las principales causas subyacentes de muchos problemas de salud, incluyendo las enfermedades cardíacas. En situaciones de estrés, el cuerpo libera hormonas como el cortisol y la adrenalina, que tienen efectos inmediatos sobre el sistema cardiovascular. Estas hormonas aumentan la frecuencia cardíaca, la presión arterial y el nivel de azúcar en sangre, lo que puede tener consecuencias a largo plazo en el corazón si no se controla.

                Cuando el estrés se convierte en una constante en la vida de una persona, los efectos sobre el corazón son acumulativos. La hipertensión arterial, que es un factor de riesgo significativo para las enfermedades cardíacas, puede desarrollarse debido al estrés crónico. Con el tiempo, la presión arterial elevada daña las arterias y aumenta la carga de trabajo del corazón, lo que incrementa el riesgo de un ataque al corazón o insuficiencia cardíaca.

                Además, el estrés emocional también puede llevar a comportamientos poco saludables, como el abuso de alcohol, el fumar o una dieta desequilibrada, todos los cuales agravan aún más el riesgo cardiovascular. Las personas estresadas a menudo descuidan su bienestar físico, lo que contribuye a la aparición de problemas de salud graves. Por ejemplo, el consumo excesivo de alimentos ricos en grasas saturadas y azúcares puede provocar obesidad, otro factor de riesgo para las enfermedades cardíacas.

                En muchos casos, el estrés crónico también está vinculado a un aumento en la inflamación en el cuerpo, lo que puede dañar los vasos sanguíneos y las arterias, promoviendo el desarrollo de aterosclerosis. Este proceso es una de las principales causas de los infartos de miocardio y otras afecciones cardiovasculares. Además, las personas que experimentan altos niveles de estrés tienen más probabilidades de tener alteraciones en su ritmo cardíaco, lo que puede aumentar el riesgo de arritmias y otras complicaciones.

                Combatir el estrés es esencial para mantener la salud cardiovascular. La adopción de técnicas de manejo del estrés, como la meditación, el yoga o la terapia cognitiva conductual, puede reducir significativamente la carga sobre el corazón. Además, la realización de actividades físicas regulares y el establecimiento de un equilibrio saludable entre el trabajo y la vida personal son fundamentales para prevenir los efectos negativos del estrés en el sistema cardiovascular.
                EOT,
            ],

            // Pediatría
            [
                'user_id' => 4,
                'category_id' => 9,
                'title' => 'El Desarrollo Psicológico de los Niños: Un Viaje Fundamental',
                'slug' => Str::slug('El Desarrollo Psicológico de los Niños: Un Viaje Fundamental'),
                'content' => <<<EOT
                El desarrollo psicológico de los niños es una de las áreas más críticas para su bienestar a largo plazo. Desde el nacimiento hasta la adolescencia, los niños atraviesan distintas etapas de crecimiento que son esenciales para su desarrollo emocional, cognitivo y social. En las primeras etapas de la vida, los niños dependen completamente de sus cuidadores para el afecto y la seguridad emocional, y cualquier alteración en este vínculo puede afectar profundamente su desarrollo.

                Durante los primeros años de vida, los niños desarrollan una comprensión de sí mismos y del mundo que les rodea. Aprenden a reconocer emociones básicas, como la alegría y el miedo, y comienzan a experimentar las primeras interacciones sociales con otros niños y adultos. Estas experiencias tempranas son fundamentales para el desarrollo de su autoestima y la capacidad para formar relaciones sanas en el futuro.

                A medida que los niños crecen, su desarrollo cognitivo también avanza, lo que les permite adquirir habilidades para resolver problemas, comprender conceptos abstractos y desarrollar un lenguaje más complejo. El proceso de aprendizaje no solo depende de la enseñanza formal, sino también de las interacciones cotidianas con su entorno y los adultos. Los niños que tienen la oportunidad de explorar y experimentar en un entorno seguro y estimulante tienden a desarrollar una mayor confianza en sus habilidades y una mentalidad más abierta.

                Sin embargo, no todos los niños se desarrollan de la misma manera, y factores como el entorno familiar, las experiencias traumáticas o las condiciones de salud mental pueden tener un impacto significativo en su desarrollo psicológico. Los niños que enfrentan dificultades emocionales o mentales durante sus primeros años a menudo tienen problemas para formar vínculos emocionales saludables y pueden experimentar dificultades académicas o sociales en el futuro.

                La intervención temprana es crucial para abordar cualquier desafío psicológico que los niños puedan enfrentar. Los padres, educadores y profesionales de la salud deben trabajar juntos para identificar señales tempranas de problemas emocionales o de comportamiento y proporcionar el apoyo necesario. A través de una atención adecuada, los niños pueden superar muchas de las dificultades que enfrentan, asegurando que su desarrollo psicológico sea lo más saludable posible.
                EOT,
            ],

            [
                'user_id' => 4,
                'category_id' => 9,
                'title' => 'El Rol de la Pediatría en el Manejo de Trastornos del Sueño Infantil',
                'slug' => Str::slug('El Rol de la Pediatría en el Manejo de Trastornos del Sueño Infantil'),
                'content' => <<<EOT
                El sueño es un componente fundamental del bienestar de los niños. Sin embargo, los trastornos del sueño son comunes en la infancia y pueden afectar significativamente la salud física y emocional de los niños. La pediatría juega un papel crucial en la identificación, diagnóstico y tratamiento de estos trastornos, que incluyen insomnio, terrores nocturnos, apnea del sueño y problemas relacionados con la somnolencia excesiva.

                El insomnio infantil es un trastorno del sueño frecuente que afecta tanto a los niños pequeños como a los adolescentes. Se caracteriza por la dificultad para conciliar el sueño o mantenerlo durante la noche. Los factores que contribuyen al insomnio pueden ser variados e incluyen problemas emocionales, preocupaciones escolares, y hábitos de sueño inadecuados. El tratamiento puede incluir cambios en los hábitos de sueño, como establecer una rutina nocturna consistente, y, en algunos casos, intervenciones médicas o psicológicas.

                Los terrores nocturnos y las pesadillas son otros trastornos comunes en los niños, especialmente en aquellos que están en la fase preescolar. Aunque estos trastornos son generalmente benignos y suelen desaparecer con el tiempo, pueden ser aterradores tanto para el niño como para los padres. Los pediatras a menudo brindan orientación sobre cómo manejar estos episodios y cuándo es necesario buscar una evaluación más profunda si los episodios persisten o empeoran.

                La apnea del sueño es otro trastorno que afecta a una gran cantidad de niños, particularmente aquellos con sobrepeso, hipertrofia de las amígdalas o adenoides agrandadas. Esta condición se caracteriza por interrupciones en la respiración durante el sueño, lo que puede causar problemas tanto a nivel físico como cognitivo. El tratamiento puede involucrar cambios en el estilo de vida, como una pérdida de peso y el tratamiento de las infecciones respiratorias, o en algunos casos, cirugía para corregir las obstrucciones en las vías respiratorias.

                A través de la consulta regular con un pediatra, los padres pueden recibir la orientación necesaria para asegurarse de que sus hijos duerman lo suficiente y de manera saludable. Es importante que los trastornos del sueño sean tratados con seriedad, ya que un sueño adecuado es esencial para el desarrollo físico, emocional y cognitivo de los niños. La intervención temprana es clave para asegurar que los niños crezcan saludables y felices.
                EOT,
            ],

            // Ginecología
            [
                'user_id' => 5,
                'category_id' => 5,
                'title' => 'La Menstruación: Entendiendo los Ciclos Menstruales y su Importancia',
                'slug' => Str::slug('La Menstruación: Entendiendo los Ciclos Menstruales y su Importancia'),
                'content' => <<<EOT
                La menstruación es una parte fundamental del ciclo reproductivo femenino y es importante para la salud general de la mujer. Aunque se trata de un proceso natural, muchas mujeres no entienden completamente cómo funciona su ciclo menstrual y cómo esto afecta su bienestar físico y emocional. A lo largo de la vida de una mujer, los ciclos menstruales pueden variar en frecuencia, duración e intensidad, pero siempre son una indicación de que el cuerpo está funcionando de manera saludable.

                Durante cada ciclo menstrual, el cuerpo se prepara para un posible embarazo. Si no ocurre la fecundación, el revestimiento del útero se desprende y es expulsado, lo que conocemos como menstruación. Un ciclo menstrual típico dura alrededor de 28 días, aunque puede ser más corto o más largo, dependiendo de la mujer. Las variaciones en la duración y la intensidad del flujo menstrual son normales, pero si una mujer experimenta cambios significativos o dolor intenso, es importante consultar con un ginecólogo.

                Los ciclos menstruales tienen un impacto directo sobre la salud hormonal y emocional de la mujer. Las fluctuaciones hormonales que ocurren durante el ciclo pueden causar cambios en el estado de ánimo, como irritabilidad o ansiedad, y pueden influir en otros aspectos de la salud, como el sueño y la energía. Además, el síndrome premenstrual (SPM) es un trastorno común que afecta a muchas mujeres en la fase luteal del ciclo, causando síntomas físicos y emocionales desagradables.

                Un ciclo menstrual irregular o la ausencia de menstruación puede ser un signo de un trastorno subyacente, como el síndrome de ovario poliquístico (SOP), la endometriosis o problemas hormonales. Es importante que las mujeres se sometan a chequeos regulares con un ginecólogo para asegurarse de que sus ciclos menstruales sean normales y saludables. Los ginecólogos pueden recomendar tratamientos, como anticonceptivos hormonales o cambios en el estilo de vida, para ayudar a regular el ciclo y aliviar los síntomas.

                Entender y seguir de cerca el ciclo menstrual puede proporcionar información valiosa sobre la salud general de la mujer. Las mujeres deben estar conscientes de los cambios en su ciclo y consultar con un ginecólogo si notan irregularidades o problemas recurrentes. Mantener una buena salud menstrual no solo es esencial para la fertilidad, sino también para el bienestar general.
                EOT,
            ],
            [
                'user_id' => 3,
                'category_id' => 1,
                'title' => 'Importancia de la Salud Cardiovascular',
                'slug' => Str::slug('Importancia de la Salud Cardiovascular'),
                'content' => <<<EOT
                Mantener una buena salud cardiovascular es crucial para una vida prolongada y saludable. A continuación, abordamos algunos puntos clave:

                **1. Beneficios de una dieta balanceada para el corazón:**
                - Consumir frutas y verduras frescas.
                - Reducir el consumo de grasas saturadas y trans.
                - Mantener niveles óptimos de colesterol.

                **2. Importancia del ejercicio regular:**
                - Realizar al menos 150 minutos de ejercicio moderado por semana.
                - Ejercicios recomendados: caminar, nadar y ciclismo.
                - Beneficios del ejercicio para la presión arterial.

                **3. Síntomas de alerta y prevención:**
                - Conocer los síntomas de un ataque cardíaco.
                - Realizar chequeos regulares con su cardiólogo.
                - Importancia de medir la presión arterial y los niveles de colesterol.

                **4. Estrategias para dejar de fumar:**
                - Programas de apoyo y consejería.
                - Uso de parches y chicles de nicotina.
                - Beneficios inmediatos al dejar de fumar.

                **5. Preguntas frecuentes:**
                Q: ¿Cuáles son los primeros síntomas de un problema cardíaco?
                A: Dolor en el pecho, dificultad para respirar y sudoración excesiva.
                Q: ¿Es beneficioso consumir alcohol en moderación?
                A: Sí, especialmente vino tinto, pero siempre bajo recomendación médica.
                EOT,
            ],
            [
                'user_id' => 3,
                'category_id' => 1,
                'title' => 'Ejercicios Efectivos para la Salud del Corazón',
                'slug' => Str::slug('Ejercicios Efectivos para la Salud del Corazón'),
                'content' => <<<EOT
                Los ejercicios físicos son esenciales para mantener un corazón saludable. Aquí te presentamos algunos de los más efectivos:

                **1. Beneficios del ejercicio aeróbico:**
                - Mejora la circulación sanguínea.
                - Aumenta la capacidad pulmonar.
                - Ejemplos: correr, nadar y bailar.

                **2. Entrenamiento de fuerza y resistencia:**
                - Aumenta la masa muscular.
                - Mejora la resistencia cardíaca.
                - Ejercicios recomendados: levantamiento de pesas y ejercicios con bandas elásticas.

                **3. Yoga y meditación para reducir el estrés:**
                - Mejora la flexibilidad.
                - Reduce los niveles de estrés y ansiedad.
                - Beneficios del yoga para la salud cardiovascular.

                **4. Consejos para una rutina efectiva:**
                - Comenzar despacio y aumentar gradualmente la intensidad.
                - Mantener una rutina constante y variada.
                - Consultar con un cardiólogo antes de comenzar un nuevo programa de ejercicios.

                **5. Preguntas frecuentes:**
                Q: ¿Cuánto tiempo debería dedicar al ejercicio cada semana?
                A: Al menos 150 minutos de ejercicio moderado o 75 minutos de ejercicio vigoroso.
                Q: ¿Es seguro hacer ejercicios si tengo una enfermedad cardíaca?
                A: Sí, pero es crucial hacerlo bajo la supervisión de un profesional de salud.
                EOT,
            ],
            [
                'user_id' => 4,
                'category_id' => 9,
                'title' => 'Consejos de Salud para Niños en Edad Escolar',
                'slug' => Str::slug('Consejos de Salud para Niños en Edad Escolar'),
                'content' => <<<EOT
                La salud de los niños en edad escolar es fundamental para su desarrollo integral. Aquí algunos consejos:

                **1. Alimentación equilibrada:**
                - Incluir frutas y verduras en cada comida.
                - Limitar el consumo de azúcares y alimentos procesados.
                - Importancia de los lácteos en el crecimiento.

                **2. Actividad física regular:**
                - Fomentar el juego activo y los deportes.
                - Beneficios del ejercicio diario para los niños.
                - Ejercicios recomendados: saltar la cuerda, juegos al aire libre.

                **3. Higiene personal:**
                - Enseñar la importancia del lavado de manos.
                - Hábitos de higiene dental.
                - Uso adecuado de mascarillas y desinfección en tiempos de pandemia.

                **4. Importancia del sueño:**
                - Horarios regulares para acostarse y despertarse.
                - Cantidad de horas de sueño recomendadas según la edad.
                - Creación de un ambiente propicio para el descanso.

                **5. Preguntas frecuentes:**
                Q: ¿Cuántas horas de sueño necesita un niño en edad escolar?
                A: Entre 9 y 11 horas por noche.
                Q: ¿Qué hacer si mi hijo no quiere comer vegetales?
                A: Intentar ofrecerlos en diversas formas y involucrar al niño en la preparación de las comidas.
                EOT,
            ],
            [
                'user_id' => 4,
                'category_id' => 9,
                'title' => 'Vacunas Esenciales para Niños',
                'slug' => Str::slug('Vacunas Esenciales para Niños'),
                'content' => <<<EOT
                La vacunación es una parte crucial del cuidado de la salud infantil. Aquí te explicamos por qué:

                **1. Importancia de las vacunas:**
                - Prevención de enfermedades graves.
                - Creación de inmunidad comunitaria.
                - Reducción de la mortalidad infantil.

                **2. Calendario de vacunación:**
                - Vacunas recomendadas desde el nacimiento hasta los 18 años.
                - Importancia de seguir el calendario de vacunación.
                - Vacunas adicionales en caso de viajes internacionales.

                **3. Preguntas comunes sobre las vacunas:**
                - ¿Son seguras las vacunas?
                - ¿Qué hacer si mi hijo presenta una reacción adversa?

                **4. Mitos y realidades:**
                - Desmentir los mitos comunes sobre las vacunas.
                - Información basada en evidencia científica.
                - Recursos confiables para obtener más información.

                **5. Preguntas frecuentes:**
                Q: ¿Cuáles son las vacunas más importantes para los niños?
                A: Polio, DTP, MMR (sarampión, paperas y rubéola), entre otras.
                Q: ¿Qué debo hacer si mi hijo se salta una dosis de vacuna?
                A: Consultar con el pediatra para reprogramar la vacunación.
                EOT,
            ],
            [
                'user_id' => 5,
                'category_id' => 5,
                'title' => 'Consejos para un Embarazo Saludable',
                'slug' => Str::slug('Consejos para un Embarazo Saludable'),
                'content' => <<<EOT
                Un embarazo saludable es crucial para el bienestar de la madre y el bebé. Aquí te dejamos algunos consejos esenciales:

                **1. Alimentación durante el embarazo:**
                - Consumir una dieta balanceada rica en nutrientes.
                - Incluir alimentos ricos en ácido fólico y hierro.
                - Evitar el consumo de alcohol y cafeína en exceso.

                **2. Ejercicio y actividad física:**
                - Beneficios del ejercicio moderado durante el embarazo.
                - Ejercicios recomendados: caminar, natación y yoga prenatal.
                - Importancia de evitar actividades de alto impacto.

                **3. Cuidados prenatales:**
                - Programar visitas regulares al ginecólogo.
                - Realizar las pruebas prenatales recomendadas.
                - Monitoreo de la salud fetal y maternal.

                **4. Preparación para el parto:**
                - Asistir a clases de preparación para el parto.
                - Elegir un plan de parto adecuado.
                - Preparar el entorno para la llegada del bebé.

                **5. Preguntas frecuentes:**
                Q: ¿Qué alimentos debo evitar durante el embarazo?
                A: Pescados con alto contenido de mercurio, alimentos crudos o poco cocidos, y productos lácteos no pasteurizados.
                Q: ¿Es seguro viajar durante el embarazo?
                A: Sí, pero es recomendable consultar con el ginecólogo antes de planificar un viaje largo.
                EOT,
            ],

        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
