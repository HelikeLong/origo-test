import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ClientsComponent } from './components/clients/clients.component';
import { FormComponent } from './components/clients/form/form.component';
import { ListComponent } from './components/clients/list/list.component';
import {FormsModule} from "@angular/forms";
import { JoinerPipe } from './pipes/joiner.pipe';
import {IConfig, NgxMaskModule} from "ngx-mask";
import {NgSelectModule} from "@ng-select/ng-select";
import {InterceptorProvider} from "./interceptors/interceptor";
import {AuthGuardService} from "./services/auth-guard.service";
import {AuthService} from "./services/auth.service";

export const options: Partial<IConfig> | (() => Partial<IConfig>) = null;

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ClientsComponent,
    FormComponent,
    ListComponent,
    JoinerPipe
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    RouterModule.forRoot([
      {path: '', component: LoginComponent},
      {path: 'clients', component: ClientsComponent},
    ]),
    NgbModule,
    FormsModule,
    NgxMaskModule.forRoot(),
    NgSelectModule
  ],
  providers: [
     AuthService,
     AuthGuardService,
     InterceptorProvider
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
