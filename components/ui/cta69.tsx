"use client";

import React from "react";
import { Badge7 } from "@/components/ui/cta69-utils/badge7";
import { Button12 } from "@/components/ui/cta69-utils/button12";
import { cn } from "@/lib/utils";
import Link from "next/link";

interface Badge {
  label: string;
}

interface ActionButton {
  label: string;
  href: string;
}

interface Cta69Labels {
  /** Repeated phrase scrolling across the backdrop */
  marqueePhrase?: string;
  /** Short supporting line beneath the heading */
  note?: string;
  /** Fine print sitting under the button */
  footnote?: string;
}

interface Cta69Props {
  badge?: Badge;
  heading?: string;
  button?: ActionButton;
  labels?: Cta69Labels;
  className?: string;
}

export const cta69Demo: Cta69Props = {
  badge: { label: "Dipercaya 50.000+ Pelajar & Profesional" },
  heading: "Pelatihan Fundamental Skill Digital dari Nol Bersama Praktisi Terbaik.",
  button: {
    label: "Coba Belajar Gratis",
    href: "/register",
  },
  labels: {
    marqueePhrase: "Skill Digital Masa Depan",
    note: "Kuasai Web Development, AI Engineering, UI/UX Design, dan Data Science dengan kurikulum standar industri. Bangun portofolio nyata, dan raih sertifikat resmi.",
    footnote: "⚡ Pendaftaran batch baru dibuka · Akses seumur hidup · Sertifikat resmi terverifikasi.",
  },
};

/**
 * How many times the phrase is written into one half of the marquee.
 */
const REPEATS = 8;

export function Cta69({
  badge = cta69Demo.badge,
  heading = cta69Demo.heading,
  button = cta69Demo.button,
  labels = cta69Demo.labels,
  className,
}: Cta69Props) {
  const marqueePhrase = labels?.marqueePhrase;
  const marqueeLine = marqueePhrase
    ? `${marqueePhrase} · `.repeat(REPEATS)
    : "";

  return (
    <section
      className={cn(
        "relative overflow-hidden bg-background py-20 md:py-28 w-full font-sans",
        className,
      )}
    >
      <style jsx>{`
        @keyframes cta69-marquee {
          from {
            transform: translateX(0);
          }
          to {
            transform: translateX(-50%);
          }
        }
      `}</style>

      {/* Top subtle radial glow */}
      <div
        aria-hidden="true"
        className="pointer-events-none absolute -top-24 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[radial-gradient(ellipse_at_center,rgba(99,102,241,0.18),transparent_70%)] z-0"
      />

      {/* Giant scrolling backdrop */}
      {marqueePhrase && (
        <div
          aria-hidden="true"
          className="pointer-events-none absolute inset-0 flex items-center overflow-hidden select-none z-0"
        >
          <div className="flex w-max shrink-0 animate-[cta69-marquee_42s_linear_infinite] whitespace-nowrap text-foreground/[0.045] dark:text-foreground/[0.06]">
            {[0, 1].map((copy) => (
              <span
                key={copy}
                className="text-[20vw] font-extrabold uppercase leading-none tracking-tighter md:text-[15vw] select-none"
              >
                {marqueeLine}
              </span>
            ))}
          </div>
        </div>
      )}

      {/* Centered statement */}
      <div className="relative z-10 mx-auto flex max-w-5xl flex-col items-center px-4 text-center md:px-6">
        {badge && <Badge7 label={badge.label} />}

        {heading && (
          <h1 className="mt-8 text-balance text-4xl font-extrabold leading-[1.12] tracking-tight text-foreground md:text-5xl lg:text-6xl max-w-4xl">
            {heading}
          </h1>
        )}

        {labels?.note && (
          <p className="mt-6 max-w-3xl text-balance text-lg text-muted-foreground md:text-xl leading-relaxed">
            {labels.note}
          </p>
        )}

        {button && (
          <div className="mt-10">
            <Button12 asChild label={button.label}>
              <Link href={button.href} />
            </Button12>
          </div>
        )}

        {labels?.footnote && (
          <p className="mt-8 text-sm md:text-base text-muted-foreground">
            {labels.footnote}
          </p>
        )}
      </div>
    </section>
  );
}

export default Cta69;
