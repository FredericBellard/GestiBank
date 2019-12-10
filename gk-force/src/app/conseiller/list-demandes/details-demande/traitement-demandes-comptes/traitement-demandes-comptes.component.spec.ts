import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TraitementDemandesComptesComponent } from './traitement-demandes-comptes.component';

describe('TraitementDemandesComptesCourantsComponent', () => {
  let component: TraitementDemandesComptesComponent;
  let fixture: ComponentFixture<TraitementDemandesComptesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TraitementDemandesComptesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TraitementDemandesComptesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
