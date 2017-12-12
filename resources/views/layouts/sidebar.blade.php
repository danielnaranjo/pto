<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
    <div class="m-quick-sidebar__content m--hide">
        <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
            <i class="la la-close"></i>
        </span>
        <!-- <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
                    Escribinos
                </a>
            </li>
        </ul> -->
        <div class="tab-content">
            <div class="tab-pane active m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                    {!! Form::open(['url' => '', 'id'=> 'comentar']) !!}
                    <div class="form-group m-form__group row">
                        {!! Form::label('propietario','propietario') !!}
                        {!! Form::text('com_propietario', null, ['class' => 'form-control', 'id' => 'com_propietario', 'placeholder'=>'ej. Pedro Perez']) !!}
                	</div>
                    <div class="form-group m-form__group row">
                        {!! Form::label('e-mail','e-mail') !!}
                        {!! Form::email('com_email', null, ['class' => 'form-control', 'id' => 'com_email', 'placeholder'=>'ej. nombre@correo.com.ar']) !!}
                    </div>
                    <div class="form-group m-form__group row">
                        {!! Form::label('telefono','telefono') !!}
                        {!! Form::text('com_telefono', null, ['class' => 'form-control', 'id' => 'com_telefono', 'placeholder'=>'ej. 48112234']) !!}
                	</div>
                    <div class="form-group m-form__group row">
                        {!! Form::label('departamento','departamento') !!}
                        {!! Form::text('com_departamento', null, ['class' => 'form-control', 'id' => 'com_departamento', 'placeholder'=>'ej. 3F']) !!}
                	</div>
                    <div class="form-group m-form__group row">
                        {!! Form::label('comentarios','comentarios') !!}
                        {!! Form::textarea('com_comentarios', null, ['class' => 'form-control', 'id' => 'com_comentarios', 'rows'=> '5', 'placeholder'=>'ej. Escribe acá']) !!}
                	</div>
                    @if (Session::has('consorcio'))
                    {!! Form::hidden ('com_consorcio', Session::get('consorcio')[0]->con_id, ['id' => 'com_consorcio']) !!}
                    {!! Form::hidden ('com_inmobiliaria', Session::get('consorcio')[0]->con_inmobiliaria, ['id' => 'com_inmobiliaria']) !!}
                    @endif
                    {{ Form::submit('Enviar consulta', ['class'=>'btn btn-info m-btn--pill','id'=>'btnSidebar']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
