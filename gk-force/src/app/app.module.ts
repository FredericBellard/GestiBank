import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from "@angular/forms";
import { HttpClientModule } from '@angular/common/http';
import { RouterModule, Routes } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AccueilComponent } from './accueil/accueil.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { AdminComponent } from './admin/admin.component';
import { GererConseillerComponent } from './admin/gererConseiller/gererConseiller.component';
import { EspaceClientComponent } from './espace-client/espace-client.component';
import { CompteClientComponent } from './compte-client/compte-client.component';
import { OperationComponent } from './operation/operation.component';
import { ListConseillersComponent } from './admin/gererConseiller/listConseillers/listConseillers.component';
import { ConseillerComponent } from './conseiller/conseiller.component';
import { ListDemandesComponent } from './conseiller/list-demandes/list-demandes.component';
import { ListComptesCourantsComponent } from './conseiller/list-comptes-courants/list-comptes-courants.component';
import { ListComptesRemsComponent } from './conseiller/list-comptes-rems/list-comptes-rems.component';
import { AffecterConseillerComponent } from './admin/affecterConseiller/affecterConseiller.component';
import { DetailsClientComponent } from './conseiller/list-comptes-courants/details-client/details-client.component';
import { DetailsClientRemComponent } from './conseiller/list-comptes-rems/details-client-rem/details-client-rem.component';
import { DetailsDemandeComponent } from './conseiller/list-demandes/details-demande/details-demande.component';
import { TraitementDemandesComptesComponent } from './conseiller/list-demandes/details-demande/traitement-demandes-comptes/traitement-demandes-comptes.component';
import { DemandesComponent } from './demandes/demandes.component';
import { DetailTransactionsComponent } from './detail-transactions/detail-transactions.component';
import { DetailsTransactionsComponent } from './conseiller/list-comptes-courants/details-transactions/details-transactions.component';
import { RefusDemandeComponent } from './conseiller/list-demandes/details-demande/refus-demande/refus-demande.component';

//const appRoutesConseillers: Routes = [
  //{ path: 'demandes', component: ListDemandesComponent },
  //{ path: 'comptes-courants', component: ListComptesCourantsComponent },
  //{ path: 'comptes-rems', component: ListComptesRemsComponent },
//];

@NgModule({
  declarations: [
    AppComponent,
    AccueilComponent,
    InscriptionComponent,
    ConnexionComponent,
    ListConseillersComponent,
    AdminComponent,
    GererConseillerComponent,
    AffecterConseillerComponent,
    EspaceClientComponent,
    CompteClientComponent,
    OperationComponent,
    ConseillerComponent,
    ListDemandesComponent,
    ListComptesCourantsComponent,
    ListComptesRemsComponent,
    DetailsClientComponent,
    DetailsClientRemComponent,
    DetailsDemandeComponent,
    TraitementDemandesComptesComponent,
    DemandesComponent,
    DetailTransactionsComponent,
    DetailsTransactionsComponent,
    RefusDemandeComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule,
    //RouterModule.forRoot(appRoutesConseillers)
  ],

  //declarations: [
    //AppComponent,
    //ListDemandesComponent,
    //ListComptesCourantsComponent,
    //ListComptesRemsComponent,
  //],

  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
