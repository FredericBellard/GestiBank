import { AccueilComponent } from './accueil/accueil.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { AdminComponent } from './admin/admin.component';
import { GererConseillerComponent } from './admin/gererConseiller/gererConseiller.component';
import { EspaceClientComponent } from './espace-client/espace-client.component';
import { CompteClientComponent } from './compte-client/compte-client.component';
import { OperationComponent } from './operation/operation.component';
import { ConseillerComponent } from './conseiller/conseiller.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AffecterConseillerComponent } from './admin/affecterConseiller/affecterConseiller.component';



const routes: Routes = [
  { path: 'accueil', component: AccueilComponent },
  { path: 'inscription', component: InscriptionComponent },
  { path: 'connexion', component: ConnexionComponent },
  { path: 'admin', component: AdminComponent },
  { path: 'admin/gererConseiller', component: GererConseillerComponent },
  { path: 'admin/affecterConseiller', component: AffecterConseillerComponent},
  { path: 'espace-client', component: EspaceClientComponent },
  { path: 'compte-client', component: CompteClientComponent },
  { path: 'operation', component: OperationComponent },
  { path: 'conseiller', component: ConseillerComponent },
  { path: '', redirectTo: 'accueil', pathMatch: 'full'}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})

export class AppRoutingModule { }
