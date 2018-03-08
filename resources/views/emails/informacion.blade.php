<p>
    Hola {{ $user }}
</p>
<p>
    Queremos agradecerte por pertenecer a Paqueto, sin embargo, en pro de mantener la confianza en nuestros usuarios, les pedimos a todos que completen sus datos personales faltantes y mantengan actualizada su información personal y de contacto.
</p>
<p>
    Hemos notado que tienes algunos datos faltantes:
</p>
<ul>
    {{-- @forelse (faltantes as $faltante)--}}
    <li>
        {{-- $faltante --}}
    </li>
    {{-- @empty --}}
    <li>Ha ocurrido un error al momento de cargar la información. Contacta a soporte.</li>
    {{-- @endforelse --}}
</ul>
<p>
    Agrademos que te tomes unos minutos para completar la información. En caso contrario, el sistema suspenderá la cuenta de forma automatica y tus datos quedaran bloquaados.
</p>
<p>
	Saludos cordiales,
</p>
<p>
	<b>Daniel N.</b><br>
	<a href="//www.paqueto.com.ve?utm_source=welcome&utm_medium=mail" target="_blank">www.paqueto.com.ve</a>
</p>
<hr/>
<p>
	Este es un mensaje automatico fue enviado a <a href="mailto:{{-- $email --}}">{{-- $email --}}</a> porque te registraste en <a href="//www.paqueto.com.ve?utm_source=welcome&utm_medium=mail" target="_blank">www.paqueto.com.ve</a> el {{-- $fecha --}}.
</p>
