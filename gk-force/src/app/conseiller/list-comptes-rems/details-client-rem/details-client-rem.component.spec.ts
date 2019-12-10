import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailsClientRemComponent } from './details-client-rem.component';

describe('DetailsClientRemComponent', () => {
  let component: DetailsClientRemComponent;
  let fixture: ComponentFixture<DetailsClientRemComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailsClientRemComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailsClientRemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
