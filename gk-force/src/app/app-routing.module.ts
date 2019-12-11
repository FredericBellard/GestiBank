import { AccueilComponent } from './accueil/accueil.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { AdminComponent } from './admin/admin.component';
import { GererConseillerComponent } from './admin/gererConseiller/gererConseiller.component';
import { EspaceClientComponent } from './espace-client/espace-client.component';
import { CompteClientComponent } from './compte-client/compte-client.component';
import { OperationComponent } from './operation/operation.component';
import { ConseillerComponent } from './conseiller/conseiller.component';
import { ListDemandesComponent } from './conseiller/list-demandes/list-demandes.component';
import { ListComptesCourantsComponent } from './conseiller/list-comptes-courants/list-comptes-courants.component';
import { ListComptesRemsComponent } from './conseiller/list-comptes-rems/list-comptes-rems.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AffecterConseillerComponent } from './admin/affecterConseiller/affecterConseiller.component';
import { DetailsClientComponent } from './conseiller/list-comptes-courants/details-client/details-client.component';
import { DetailsClientRemComponent } from './conseiller/list-comptes-rems/details-client-rem/details-client-rem.component';
import { DetailsDemandeComponent } from './conseiller/list-demandes/details-demande/details-demande.component';
import { TraitementDemandesComptesComponent } from './conseiller/list-demandes/details-demande/traitement-demandes-comptes/traitement-demandes-comptes.component';
import { DemandesComponent } from './demandes/demandes.component';
import { DetailTransactionsComponent } from './detail-transactions/detail-transactions.component';



const routes: Routes = [
  { path: 'accueil', component: AccueilComponent },
  { path: 'inscription', component: InscriptionComponent },
  { path: 'connexion', component: ConnexionComponent },
  { path: 'admin', component: AdminComponent },
  { path: 'admin/gererConseiller', component: GererConseillerComponent },
  { path: 'admin/affecterConseiller', component: AffecterConseillerComponent},
  { path: 'espace-client', component: EspaceClientComponent },
  { path: 'compte-client/:id', component: CompteClientComponent },
  { path: 'compte-clients', component: CompteClientComponent },
  { path: 'operation', component: OperationComponent },
  { path: 'conseiller', component: ConseillerComponent },
  { path: 'demandes', component: ListDemandesComponent },
  { path: 'comptes-courants', component: ListComptesCourantsComponent },
  { path: 'comptes-rems', component: ListComptesRemsComponent },
  { path: 'details-client/:id', component: DetailsClientComponent },
  { path: 'details-client-rem/:id', component: DetailsClientRemComponent },
  { path: 'details-demande/:ref', component: DetailsDemandeComponent},
  { path: 'traitement-demandes-comptes/:ref', component: TraitementDemandesComptesComponent}, 
  //{ path: 'details-demande/:ref/validation', component: TraitementDemandesComptesComponent}, 
  { path: 'demandes-client', component: DemandesComponent },
  { path: 'detail-transaction/:id', component: DetailTransactionsComponent },
  { path: 'detail-transactions', component: DetailTransactionsComponent },
  { path: '', redirectTo: 'accueil', pathMatch: 'full'}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})

export class AppRoutingModule { }
