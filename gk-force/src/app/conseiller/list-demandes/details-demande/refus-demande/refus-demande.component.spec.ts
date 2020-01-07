import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RefusDemandeComponent } from './refus-demande.component';

describe('RefusDemandeComponent', () => {
  let component: RefusDemandeComponent;
  let fixture: ComponentFixture<RefusDemandeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RefusDemandeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RefusDemandeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
