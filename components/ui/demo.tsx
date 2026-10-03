import React from "react";
import { Cta69 } from "@/components/ui/cta69";

export default function Cta69Demo() {
  return (
    <Cta69
      badge={{ label: "Dipercaya 50.000+ Pelajar & Profesional" }}
      heading="Pelatihan Fundamental Skill Digital dari Nol Bersama Praktisi Terbaik."
      button={{ label: "Coba Belajar Gratis", href: "/register" }}
      labels={{
        marqueePhrase: "Skill Digital Masa Depan",
        note: "Kuasai Web Development, AI Engineering, UI/UX Design, dan Data Science dengan kurikulum standar industri. Bangun portofolio nyata, dan raih sertifikat resmi.",
        footnote: "⚡ Pendaftaran batch baru dibuka · Akses seumur hidup · Sertifikat resmi terverifikasi.",
      }}
    />
  );
}
