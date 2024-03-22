window.onload = function () {
    const e = document.querySelector("#droparea"),
        a = document.querySelector("#photo");
    function u(e) {
        e.preventDefault(), e.stopPropagation();
    }
    e.addEventListener("drop", (e) => {
        (a.files = e.dataTransfer.files), a.dispatchEvent(new Event("change")), e.preventDefault();
    }),
        ["dragenter", "dragover", "dragleave"].forEach((a) => {
            e.addEventListener(a, u, !1);
        });
    const l = document.querySelector("#physical-address-city"),
        v = document.querySelector("#physical-address-state"),
        r = document.querySelector("#physical-address-zip"),
        s = document.querySelector("#mailing-address-city"),
        d = document.querySelector("#mailing-address-state"),
        c = document.querySelector("#mailing-address-zip"),
        t = document.querySelector("#remittance-address-city"),
        o = document.querySelector("#remittance-address-state"),
        n = document.querySelector("#remittance-address-zip");
    l.addEventListener("change", (e) => {
        let a = e.target.value.split(" ");
        if (Array.isArray(a)) {
            let e = a[a.length - 1],
                u = a[a.length - 2],
                s = ((e, a = 1) => e.slice(0, a))(a, a.length - 2);
            (s = s.join(" ")),
            s.includes(",") && (s = s.replace(",", "")),
                (v.value = u),
                (r.value = e),
                (l.value = s),
                ($wire.physical_address_city = l.value),
                ($wire.physical_address_state = v.value),
                ($wire.physical_address_zip = r.value);
        }
    }),
        s.addEventListener("change", (e) => {
            let a = e.target.value.split(" ");
            if (Array.isArray(a)) {
                let e = a[a.length - 1],
                    u = a[a.length - 2],
                    l = ((e, a = 1) => e.slice(0, a))(a, a.length - 2);
                (l = l.join(" ")), l.includes(",") && (l = l.replace(",", "")), (d.value = u), (c.value = e), (s.value = l);
            }
            ($wire.physical_address_city = l.value), ($wire.physical_address_state = v.value), ($wire.physical_address_zip = r.value);
        }),
        t.addEventListener("change", (e) => {
            let a = e.target.value.split(" ");
            if (Array.isArray(a)) {
                let e = a[a.length - 1],
                    u = a[a.length - 2],
                    l = ((e, a = 1) => e.slice(0, a))(a, a.length - 2);
                (l = l.join(" ")), l.includes(",") && (l = l.replace(",", "")), (o.value = u), (n.value = e), (t.value = l);
            }
            ($wire.remittance_address_city = t.value), ($wire.remittance_address_state = o.value), ($wire.remittance_address_zip = n.value);
        });
    const y = document.querySelector("#office_hours_monday_copy_to"),
        i = document.querySelector("#office_hours_tuesday_copy_to"),
        _ = document.querySelector("#office_hours_wednesday_copy_to"),
        h = document.querySelector("#office_hours_thursday_copy_to"),
        k = document.querySelector("#office_hours_friday_copy_to"),
        m = document.querySelector("#office_hours_saturday_copy_to"),
        b = document.querySelector("#office_hours_sunday_copy_to"),
        w = document.querySelector("#office-hours-monday-open"),
        p = document.querySelector("#office-hours-monday-close"),
        f = document.querySelector("#office-hours-tuesday-open"),
        S = document.querySelector("#office-hours-tuesday-close"),
        q = document.querySelector("#office-hours-wednesday-open"),
        g = document.querySelector("#office-hours-wednesday-close"),
        $ = document.querySelector("#office-hours-thursday-open"),
        E = document.querySelector("#office-hours-thursday-close"),
        L = document.querySelector("#office-hours-friday-open"),
        z = document.querySelector("#office-hours-friday-close"),
        A = document.querySelector("#office-hours-saturday-open"),
        j = document.querySelector("#office-hours-saturday-close"),
        x = document.querySelector("#office-hours-sunday-open"),
        D = document.querySelector("#office-hours-sunday-close"),
        P = document.querySelector("#service_hours_monday_copy_to"),
        T = document.querySelector("#service_hours_tuesday_copy_to"),
        B = document.querySelector("#service_hours_wednesday_copy_to"),
        C = document.querySelector("#service_hours_thursday_copy_to"),
        F = document.querySelector("#service_hours_friday_copy_to"),
        G = document.querySelector("#service_hours_saturday_copy_to"),
        H = document.querySelector("#service_hours_sunday_copy_to"),
        I = document.querySelector("#service-hours-monday-open"),
        J = document.querySelector("#service-hours-monday-close"),
        K = document.querySelector("#service-hours-tuesday-open"),
        M = document.querySelector("#service-hours-tuesday-close"),
        N = document.querySelector("#service-hours-wednesday-open"),
        O = document.querySelector("#service-hours-wednesday-close"),
        Q = document.querySelector("#service-hours-thursday-open"),
        R = document.querySelector("#service-hours-thursday-close"),
        U = document.querySelector("#service-hours-friday-open"),
        V = document.querySelector("#service-hours-friday-close"),
        W = document.querySelector("#service-hours-saturday-open"),
        X = document.querySelector("#service-hours-saturday-close"),
        Y = document.querySelector("#service-hours-sunday-open"),
        Z = document.querySelector("#service-hours-sunday-close"),
        ee = document.querySelector("#after_hours_monday_copy_to"),
        ae = document.querySelector("#after_hours_tuesday_copy_to"),
        ue = document.querySelector("#after_hours_wednesday_copy_to"),
        le = document.querySelector("#after_hours_thursday_copy_to"),
        ve = document.querySelector("#after_hours_friday_copy_to"),
        re = document.querySelector("#after_hours_saturday_copy_to"),
        se = document.querySelector("#after_hours_sunday_copy_to"),
        de = document.querySelector("#after-hours-monday-open"),
        ce = document.querySelector("#after-hours-monday-close"),
        te = document.querySelector("#after-hours-tuesday-open"),
        oe = document.querySelector("#after-hours-tuesday-close"),
        ne = document.querySelector("#after-hours-wednesday-open"),
        ye = document.querySelector("#after-hours-wednesday-close"),
        ie = document.querySelector("#after-hours-thursday-open"),
        _e = document.querySelector("#after-hours-thursday-close"),
        he = document.querySelector("#after-hours-friday-open"),
        ke = document.querySelector("#after-hours-friday-close"),
        me = document.querySelector("#after-hours-saturday-open"),
        be = document.querySelector("#after-hours-saturday-close"),
        we = document.querySelector("#after-hours-sunday-open"),
        pe = document.querySelector("#after-hours-sunday-close"),
        fe = document.querySelector("#holiday_hours_monday_copy_to"),
        Se = document.querySelector("#holiday_hours_tuesday_copy_to"),
        qe = document.querySelector("#holiday_hours_wednesday_copy_to"),
        ge = document.querySelector("#holiday_hours_thursday_copy_to"),
        $e = document.querySelector("#holiday_hours_friday_copy_to"),
        Ee = document.querySelector("#holiday_hours_saturday_copy_to"),
        Le = document.querySelector("#holiday_hours_sunday_copy_to"),
        ze = document.querySelector("#holiday-hours-monday-open"),
        Ae = document.querySelector("#holiday-hours-monday-close"),
        je = document.querySelector("#holiday-hours-tuesday-open"),
        xe = document.querySelector("#holiday-hours-tuesday-close"),
        De = document.querySelector("#holiday-hours-wednesday-open"),
        Pe = document.querySelector("#holiday-hours-wednesday-close"),
        Te = document.querySelector("#holiday-hours-thursday-open"),
        Be = document.querySelector("#holiday-hours-thursday-close"),
        Ce = document.querySelector("#holiday-hours-friday-open"),
        Fe = document.querySelector("#holiday-hours-friday-close"),
        Ge = document.querySelector("#holiday-hours-saturday-open"),
        He = document.querySelector("#holiday-hours-saturday-close"),
        Ie = document.querySelector("#holiday-hours-sunday-open"),
        Je = document.querySelector("#holiday-hours-sunday-close");
    y.addEventListener("change", (e) => {
        let a = w.value,
            u = p.value;
        switch (y.value) {
            case "every-day":
                (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u), (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                break;
            case "weekdays":
                (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u);
                break;
            case "weekends":
                (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                break;
            case "tuesday":
                (f.value = a), (S.value = u);
                break;
            case "wednesday":
                (q.value = a), (g.value = u);
                break;
            case "thursday":
                ($.value = a), (E.value = u);
                break;
            case "friday":
                (L.value = a), (z.value = u);
                break;
            case "saturday":
                (A.value = a), (j.value = u);
                break;
            case "sunday":
                (x.value = a), (D.value = u);
        }
        y.value = "";
    }),
        i.addEventListener("change", (e) => {
            let a = f.value,
                u = S.value;
            switch (i.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u), (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u);
                    break;
                case "weekends":
                    (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "wednesday":
                    (q.value = a), (g.value = u);
                    break;
                case "thursday":
                    ($.value = a), (E.value = u);
                    break;
                case "friday":
                    (L.value = a), (z.value = u);
                    break;
                case "saturday":
                    (A.value = a), (j.value = u);
                    break;
                case "sunday":
                    (x.value = a), (D.value = u);
            }
            i.value = "";
        }),
        _.addEventListener("change", (e) => {
            let a = q.value,
                u = g.value;
            switch (_.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u), (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u);
                    break;
                case "weekends":
                    (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "tuesday":
                    (f.value = a), (S.value = u);
                    break;
                case "thursday":
                    ($.value = a), (E.value = u);
                    break;
                case "friday":
                    (L.value = a), (z.value = u);
                    break;
                case "saturday":
                    (A.value = a), (j.value = u);
                    break;
                case "sunday":
                    (x.value = a), (D.value = u);
            }
            _.value = "";
        }),
        h.addEventListener("change", (e) => {
            let a = $.value,
                u = E.value;
            switch (h.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), (L.value = a), (z.value = u), (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), (L.value = a), (z.value = u);
                    break;
                case "weekends":
                    (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "tuesday":
                    (f.value = a), (S.value = u);
                    break;
                case "wednesday":
                    (q.value = a), (g.value = u);
                    break;
                case "friday":
                    (L.value = a), (z.value = u);
                    break;
                case "saturday":
                    (A.value = a), (j.value = u);
                    break;
                case "sunday":
                    (x.value = a), (D.value = u);
            }
        }),
        k.addEventListener("change", (e) => {
            let a = L.value,
                u = z.value;
            switch (k.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u);
                    break;
                case "weekends":
                    (A.value = a), (j.value = u), (x.value = a), (D.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "tuesday":
                    (f.value = a), (S.value = u);
                    break;
                case "wednesday":
                    (q.value = a), (g.value = u);
                    break;
                case "thursday":
                    ($.value = a), (E.value = u);
                    break;
                case "saturday":
                    (A.value = a), (j.value = u);
                    break;
                case "sunday":
                    (x.value = a), (D.value = u);
            }
            k.value = "";
        }),
        m.addEventListener("change", (e) => {
            let a = A.value,
                u = j.value;
            switch (m.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u), (x.value = a), (D.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u);
                    break;
                case "weekends":
                case "sunday":
                    (x.value = a), (D.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "tuesday":
                    (f.value = a), (S.value = u);
                    break;
                case "wednesday":
                    (q.value = a), (g.value = u);
                    break;
                case "thursday":
                    ($.value = a), (E.value = u);
                    break;
                case "friday":
                    (L.value = a), (z.value = u);
            }
            m.value = "";
        }),
        b.addEventListener("change", (e) => {
            let a = x.value,
                u = D.value;
            switch (b.value) {
                case "every-day":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u), (L.value = a), (z.value = u), (A.value = a), (j.value = u);
                    break;
                case "weekdays":
                    (w.value = a), (p.value = u), (f.value = a), (S.value = u), (q.value = a), (g.value = u), ($.value = a), (E.value = u);
                    break;
                case "weekends":
                case "saturday":
                    (A.value = a), (j.value = u);
                    break;
                case "monday":
                    (w.value = a), (p.value = u);
                    break;
                case "tuesday":
                    (f.value = a), (S.value = u);
                    break;
                case "wednesday":
                    (q.value = a), (g.value = u);
                    break;
                case "thursday":
                    ($.value = a), (E.value = u);
                    break;
                case "friday":
                    (L.value = a), (z.value = u);
            }
            b.value = "";
        }),
        P.addEventListener("change", (e) => {
            let a = I.value,
                u = J.value;
            switch (P.value) {
                case "every-day":
                    (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u), (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u);
                    break;
                case "weekends":
                    (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
                    break;
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "sunday":
                    (Y.value = a), (Z.value = u);
            }
            P.value = "";
        }),
        T.addEventListener("change", (e) => {
            let a = K.value,
                u = M.value;
            switch (T.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u), (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u);
                    break;
                case "weekends":
                    (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
                    break;
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "sunday":
                    (Y.value = a), (Z.value = u);
            }
            T.value = "";
        }),
        B.addEventListener("change", (e) => {
            let a = N.value,
                u = O.value;
            switch (B.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u), (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u);
                    break;
                case "weekends":
                    (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
                    break;
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "sunday":
                    (Y.value = a), (Z.value = u);
            }
            B.value = "";
        }),
        C.addEventListener("change", (e) => {
            let a = Q.value,
                u = R.value;
            switch (C.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (U.value = a), (V.value = u), (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (U.value = a), (V.value = u);
                    break;
                case "weekends":
                    (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
                    break;
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "sunday":
                    (Y.value = a), (Z.value = u);
            }
        }),
        F.addEventListener("change", (e) => {
            let a = U.value,
                u = V.value;
            switch (F.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u);
                    break;
                case "weekends":
                    (W.value = a), (X.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "sunday":
                    (Y.value = a), (Z.value = u);
            }
            F.value = "";
        }),
        G.addEventListener("change", (e) => {
            let a = W.value,
                u = X.value;
            switch (G.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u), (Y.value = a), (Z.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u);
                    break;
                case "weekends":
                case "sunday":
                    (Y.value = a), (Z.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
            }
            G.value = "";
        }),
        H.addEventListener("change", (e) => {
            let a = Y.value,
                u = Z.value;
            switch (H.value) {
                case "every-day":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u), (U.value = a), (V.value = u), (W.value = a), (X.value = u);
                    break;
                case "weekdays":
                    (I.value = a), (J.value = u), (K.value = a), (M.value = u), (N.value = a), (O.value = u), (Q.value = a), (R.value = u);
                    break;
                case "weekends":
                case "saturday":
                    (W.value = a), (X.value = u);
                    break;
                case "monday":
                    (I.value = a), (J.value = u);
                    break;
                case "tuesday":
                    (K.value = a), (M.value = u);
                    break;
                case "wednesday":
                    (N.value = a), (O.value = u);
                    break;
                case "thursday":
                    (Q.value = a), (R.value = u);
                    break;
                case "friday":
                    (U.value = a), (V.value = u);
            }
            H.value = "";
        }),
        ee.addEventListener("change", (e) => {
            let a = de.value,
                u = ce.value;
            switch (ee.value) {
                case "every-day":
                    (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u), (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u);
                    break;
                case "weekends":
                    (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
                    break;
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "sunday":
                    (we.value = a), (pe.value = u);
            }
            ee.value = "";
        }),
        ae.addEventListener("change", (e) => {
            let a = te.value,
                u = oe.value;
            switch (ae.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u), (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u);
                    break;
                case "weekends":
                    (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
                    break;
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "sunday":
                    (we.value = a), (pe.value = u);
            }
            ae.value = "";
        }),
        ue.addEventListener("change", (e) => {
            let a = ne.value,
                u = ye.value;
            switch (ue.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u), (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u);
                    break;
                case "weekends":
                    (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
                    break;
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "sunday":
                    (we.value = a), (pe.value = u);
            }
            ue.value = "";
        }),
        le.addEventListener("change", (e) => {
            let a = ie.value,
                u = _e.value;
            switch (le.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (he.value = a), (ke.value = u), (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (he.value = a), (ke.value = u);
                    break;
                case "weekends":
                    (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
                    break;
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "sunday":
                    (we.value = a), (pe.value = u);
            }
        }),
        ve.addEventListener("change", (e) => {
            let a = he.value,
                u = ke.value;
            switch (ve.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u);
                    break;
                case "weekends":
                    (me.value = a), (be.value = u), (we.value = a), (pe.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "sunday":
                    (we.value = a), (pe.value = u);
            }
            ve.value = "";
        }),
        re.addEventListener("change", (e) => {
            let a = me.value,
                u = be.value;
            switch (re.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u), (we.value = a), (pe.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u);
                    break;
                case "weekends":
                case "sunday":
                    (we.value = a), (pe.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
            }
            re.value = "";
        }),
        se.addEventListener("change", (e) => {
            let a = we.value,
                u = pe.value;
            switch (se.value) {
                case "every-day":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u), (he.value = a), (ke.value = u), (me.value = a), (be.value = u);
                    break;
                case "weekdays":
                    (de.value = a), (ce.value = u), (te.value = a), (oe.value = u), (ne.value = a), (ye.value = u), (ie.value = a), (_e.value = u);
                    break;
                case "weekends":
                case "saturday":
                    (me.value = a), (be.value = u);
                    break;
                case "monday":
                    (de.value = a), (ce.value = u);
                    break;
                case "tuesday":
                    (te.value = a), (oe.value = u);
                    break;
                case "wednesday":
                    (ne.value = a), (ye.value = u);
                    break;
                case "thursday":
                    (ie.value = a), (_e.value = u);
                    break;
                case "friday":
                    (he.value = a), (ke.value = u);
            }
            se.value = "";
        }),
        fe.addEventListener("change", (e) => {
            let a = ze.value,
                u = Ae.value;
            switch (fe.value) {
                case "every-day":
                    (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u), (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u);
                    break;
                case "weekends":
                    (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
                    break;
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "sunday":
                    (Ie.value = a), (Je.value = u);
            }
            fe.value = "";
        }),
        Se.addEventListener("change", (e) => {
            let a = je.value,
                u = xe.value;
            switch (Se.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u), (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u);
                    break;
                case "weekends":
                    (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
                    break;
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "sunday":
                    (Ie.value = a), (Je.value = u);
            }
            Se.value = "";
        }),
        qe.addEventListener("change", (e) => {
            let a = De.value,
                u = Pe.value;
            switch (qe.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u), (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u);
                    break;
                case "weekends":
                    (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
                    break;
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "sunday":
                    (Ie.value = a), (Je.value = u);
            }
            qe.value = "";
        }),
        ge.addEventListener("change", (e) => {
            let a = Te.value,
                u = Be.value;
            switch (ge.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Ce.value = a), (Fe.value = u), (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Ce.value = a), (Fe.value = u);
                    break;
                case "weekends":
                    (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
                    break;
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "sunday":
                    (Ie.value = a), (Je.value = u);
            }
        }),
        $e.addEventListener("change", (e) => {
            let a = Ce.value,
                u = Fe.value;
            switch ($e.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u);
                    break;
                case "weekends":
                    (Ge.value = a), (He.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "sunday":
                    (Ie.value = a), (Je.value = u);
            }
            $e.value = "";
        }),
        Ee.addEventListener("change", (e) => {
            let a = Ge.value,
                u = He.value;
            switch (Ee.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u), (Ie.value = a), (Je.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u);
                    break;
                case "weekends":
                case "sunday":
                    (Ie.value = a), (Je.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
            }
            Ee.value = "";
        }),
        Le.addEventListener("change", (e) => {
            let a = Ie.value,
                u = Je.value;
            switch (Le.value) {
                case "every-day":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u), (Ce.value = a), (Fe.value = u), (Ge.value = a), (He.value = u);
                    break;
                case "weekdays":
                    (ze.value = a), (Ae.value = u), (je.value = a), (xe.value = u), (De.value = a), (Pe.value = u), (Te.value = a), (Be.value = u);
                    break;
                case "weekends":
                case "saturday":
                    (Ge.value = a), (He.value = u);
                    break;
                case "monday":
                    (ze.value = a), (Ae.value = u);
                    break;
                case "tuesday":
                    (je.value = a), (xe.value = u);
                    break;
                case "wednesday":
                    (De.value = a), (Pe.value = u);
                    break;
                case "thursday":
                    (Te.value = a), (Be.value = u);
                    break;
                case "friday":
                    (Ce.value = a), (Fe.value = u);
            }
            Le.value = "";
        });
    const Ke = document.querySelector("#physical-address-copy-to"),
        Me = document.querySelector("#physical-address-copy-from"),
        Ne = document.querySelector("#physical-address-building-number"),
        Oe = document.querySelector("#physical-address-pre-direction"),
        Qe = document.querySelector("#physical-address-street-name"),
        Re = document.querySelector("#physical-address-street-type"),
        Ue = document.querySelector("#physical-address-post-direction"),
        Ve = document.querySelector("#physical-address-unit"),
        We = document.querySelector("#physical-address-unit-type"),
        Xe = document.querySelector("#physical-address-po-box"),
        Ye = document.querySelector("#physical-address-city"),
        Ze = document.querySelector("#physical-address-state"),
        ea = document.querySelector("#physical-address-zip"),
        aa = document.querySelector("#mailing-address-copy-to"),
        ua = document.querySelector("#mailing-address-copy-from"),
        la = (document.querySelector("#mailing-address-type"), document.querySelector("#mailing-address-building-number")),
        va = document.querySelector("#mailing-address-pre-direction"),
        ra = document.querySelector("#mailing-address-street-name"),
        sa = document.querySelector("#mailing-address-street-type"),
        da = document.querySelector("#mailing-address-post-direction"),
        ca = document.querySelector("#mailing-address-unit"),
        ta = document.querySelector("#mailing-address-unit-type"),
        oa = document.querySelector("#mailing-address-po-box"),
        na = document.querySelector("#mailing-address-city"),
        ya = document.querySelector("#mailing-address-state"),
        ia = document.querySelector("#mailing-address-zip"),
        _a = document.querySelector("#remittance-address-copy-to"),
        ha = document.querySelector("#remittance-address-copy-from"),
        ka = (document.querySelector("#remittance-address-type"), document.querySelector("#remittance-address-building-number")),
        ma = document.querySelector("#remittance-address-pre-direction"),
        ba = document.querySelector("#remittance-address-street-name"),
        wa = document.querySelector("#remittance-address-street-type"),
        pa = document.querySelector("#remittance-address-post-direction"),
        fa = document.querySelector("#remittance-address-unit"),
        Sa = document.querySelector("#remittance-address-unit-type"),
        qa = document.querySelector("#remittance-address-po-box"),
        ga = document.querySelector("#remittance-address-city"),
        $a = document.querySelector("#remittance-address-state"),
        Ea = document.querySelector("#remittance-address-zip");
    Ke.addEventListener("change", () => {
        switch (Ke.value) {
            case "mailing":
                (la.value = Ne.value),
                    (va.value = Oe.value),
                    (ra.value = Qe.value),
                    (sa.value = Re.value),
                    (da.value = Ue.value),
                    (ca.value = Ve.value),
                    (ta.value = We.value),
                    (oa.value = Xe.value),
                    (na.value = Ye.value),
                    (ya.value = Ze.value),
                    (ia.value = ea.value);
                break;
            case "remittance":
                (ka.value = Ne.value),
                    (ma.value = Oe.value),
                    (ba.value = Qe.value),
                    (wa.value = Re.value),
                    (pa.value = Ue.value),
                    (fa.value = Ve.value),
                    (Sa.value = We.value),
                    (qa.value = Xe.value),
                    (ga.value = Ye.value),
                    ($a.value = Ze.value),
                    (Ea.value = ea.value);
        }
        Ke.value = "";
    }),
        Me.addEventListener("change", () => {
            switch (Me.value) {
                case "mailing":
                    (Ne.value = la.value),
                        (Oe.value = va.value),
                        (Qe.value = ra.value),
                        (Re.value = sa.value),
                        (Ue.value = da.value),
                        (Ve.value = ca.value),
                        (We.value = ta.value),
                        (Xe.value = oa.value),
                        (Ye.value = na.value),
                        (Ze.value = ya.value),
                        (ea.value = ia.value);
                    break;
                case "remittance":
                    (Ne.value = ka.value),
                        (Oe.value = ma.value),
                        (Qe.value = ba.value),
                        (Re.value = wa.value),
                        (Ue.value = pa.value),
                        (Ve.value = fa.value),
                        (We.value = Sa.value),
                        (Xe.value = qa.value),
                        (Ye.value = ga.value),
                        (Ze.value = $a.value),
                        (ea.value = Ea.value);
            }
            Me.value = "";
        }),
        aa.addEventListener("change", () => {
            switch (aa.value) {
                case "physical":
                    (Ne.value = la.value),
                        (Oe.value = va.value),
                        (Qe.value = ra.value),
                        (Re.value = sa.value),
                        (Ue.value = da.value),
                        (Ve.value = ca.value),
                        (We.value = ta.value),
                        (Xe.value = oa.value),
                        (Ye.value = na.value),
                        (Ze.value = ya.value),
                        (ea.value = ia.value);
                    break;
                case "remittance":
                    (ka.value = la.value),
                        (ma.value = va.value),
                        (ba.value = ra.value),
                        (wa.value = sa.value),
                        (pa.value = da.value),
                        (fa.value = ca.value),
                        (Sa.value = ta.value),
                        (qa.value = oa.value),
                        (ga.value = na.value),
                        ($a.value = ya.value),
                        (Ea.value = ia.value);
            }
            aa.value = "";
        }),
        ua.addEventListener("change", () => {
            switch (ua.value) {
                case "physical":
                    (la.value = Ne.value),
                        (va.value = Oe.value),
                        (ra.value = Qe.value),
                        (sa.value = Re.value),
                        (da.value = Ue.value),
                        (ca.value = Ve.value),
                        (ta.value = We.value),
                        (oa.value = Xe.value),
                        (na.value = Ye.value),
                        (ya.value = Ze.value),
                        (ia.value = ea.value);
                    break;
                case "remittance":
                    (la.value = ka.value),
                        (va.value = ma.value),
                        (ra.value = ba.value),
                        (sa.value = wa.value),
                        (da.value = pa.value),
                        (ca.value = fa.value),
                        (ta.value = Sa.value),
                        (oa.value = qa.value),
                        (na.value = ga.value),
                        (ya.value = $a.value),
                        (ia.value = Ea.value);
            }
            ua.value = "";
        }),
        _a.addEventListener("change", () => {
            switch (_a.value) {
                case "physical":
                    (Ne.value = ka.value),
                        (Oe.value = ma.value),
                        (Qe.value = ba.value),
                        (Re.value = wa.value),
                        (Ue.value = pa.value),
                        (Ve.value = fa.value),
                        (We.value = Sa.value),
                        (Xe.value = qa.value),
                        (Ye.value = ga.value),
                        (Ze.value = $a.value),
                        (ea.value = Ea.value);
                    break;
                case "mailing":
                    (la.value = ka.value),
                        (va.value = ma.value),
                        (ra.value = ba.value),
                        (sa.value = wa.value),
                        (da.value = pa.value),
                        (ca.value = fa.value),
                        (ta.value = Sa.value),
                        (oa.value = qa.value),
                        (na.value = ga.value),
                        (ya.value = $a.value),
                        (ia.value = Ea.value);
            }
            _a.value = "";
        }),
        ha.addEventListener("change", () => {
            switch (ha.value) {
                case "physical":
                    (ka.value = Ne.value),
                        (ma.value = Oe.value),
                        (ba.value = Qe.value),
                        (wa.value = Re.value),
                        (pa.value = Ue.value),
                        (fa.value = Ve.value),
                        (Sa.value = We.value),
                        (qa.value = Xe.value),
                        (ga.value = Ye.value),
                        ($a.value = Ze.value),
                        (Ea.value = ea.value);
                    break;
                case "mailing":
                    (ka.value = la.value),
                        (ma.value = va.value),
                        (ba.value = ra.value),
                        (wa.value = sa.value),
                        (pa.value = da.value),
                        (fa.value = ca.value),
                        (Sa.value = ta.value),
                        (qa.value = oa.value),
                        (ga.value = na.value),
                        ($a.value = ya.value),
                        (Ea.value = ia.value);
            }
            ha.value = "";
        })
};
