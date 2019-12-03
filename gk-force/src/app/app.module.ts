import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {FormsModule} from "@angular/forms";
import{HttpClientModule} from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AccueilComponent } from './accueil/accueil.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { EspaceClientComponent } from './espace-client/espace-client.component';
import { CompteClientComponent } from './compte-client/compte-client.component';
import { OperationComponent } from './operation/operation.component';

@NgModule({
  declarations: [
    AppComponent,
    AccueilComponent,
    InscriptionComponent,
    ConnexionComponent,
    EspaceClientComponent,
    CompteClientComponent,
    OperationComponent
    
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
